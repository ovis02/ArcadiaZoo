<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Mailer\MailerInterface;

// Services
use App\Entity\Service;
use App\Repository\ServiceRepository;

// Habitats
use App\Entity\Habitat;
use App\Repository\HabitatRepository;

// Animaux
use App\Entity\Animal;
use App\Repository\AnimalRepository;

// Comptes rendus vétérinaires
use App\Repository\CompteRenduVeterinaireRepository;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
final class AdminController extends AbstractController
{
    // -------- Accueil admin : Services + Habitats + CR véto (filtre par animal) --------
    #[Route('', name: 'app_admin', methods: ['GET'])]
    public function index(
        Request $request,
        ServiceRepository $serviceRepo,
        HabitatRepository $habitatRepo,
        AnimalRepository $animalRepo,
        CompteRenduVeterinaireRepository $reportRepo
    ): Response {
        // Filtre ultra simple : par animal (option "Tous" si vide)
        $animalId = $request->query->getInt('r_animal', 0);
        $criteria = [];
        if ($animalId) {
            // Clé = propriété de l'entité CompteRenduVeterinaire
            $criteria['animal'] = $animalId;
        }

        // Tri par champ "date" (présent dans ton entité), décroissant
        $reports = $reportRepo->findBy($criteria, ['date' => 'DESC']);

        return $this->render('admin/index.html.twig', [
            'services' => $serviceRepo->findBy([], ['id' => 'ASC']),
            'habitats' => $habitatRepo->findBy([], ['id' => 'ASC']),
            'animals'  => $animalRepo->findBy([], ['prenom' => 'ASC']),
            'reports'  => $reports,
            'rfilters' => [
                'animal' => $animalId ?: '',
            ],
        ]);
    }

    // ===================== Utilisateurs =====================

    #[Route('/users', name: 'admin_users', methods: ['GET'])]
    public function users(UserRepository $repo): Response
    {
        $users = $repo->findBy([], ['email' => 'ASC']);
        return $this->render('admin/users/liste.html.twig', compact('users'));
    }

    #[Route('/users/new', name: 'admin_users_new', methods: ['GET','POST'])]
    public function userNew(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher,
        MailerInterface $mailer
    ): Response {
        $user = new User();
        $form = $this->createForm(AdminUserType::class, $user, ['is_edit' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allowed = ['ROLE_EMPLOYE', 'ROLE_VETERINAIRE'];
            $posted  = (array)$form->get('roles')->getData();
            $user->setRoles(array_values(array_intersect($posted, $allowed)));

            $user->setEmail(strtolower(trim((string)$user->getEmail())));
            $plain = (string)$form->get('plainPassword')->getData();
            $user->setPassword($hasher->hashPassword($user, $plain));

            try {
                $em->persist($user);
                $em->flush();
            } catch (UniqueConstraintViolationException) {
                $this->addFlash('error', 'Cet email est déjà utilisé.');
                return $this->redirectToRoute('admin_users_new');
            }

            $email = (new TemplatedEmail())
                ->from(new Address('no-reply@zoo.com', 'Zoo Arcadia'))
                ->to(new Address((string)$user->getEmail()))
                ->subject('Votre compte a été créé')
                ->htmlTemplate('emails/user_created.html.twig')
                ->context(['username' => $user->getEmail()]);
            try { $mailer->send($email); }
            catch (\Throwable) {
                $this->addFlash('info', "Compte créé, mais l'email n'a pas pu être envoyé (MAILER_DSN).");
            }

            $this->addFlash('success', 'Utilisateur créé.');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/users/form.html.twig', [
            'form'  => $form,
            'title' => 'Nouvel utilisateur (Employé / Vétérinaire)',
        ]);
    }

    #[Route('/users/{id}/edit', name: 'admin_users_edit', methods: ['GET','POST'])]
    public function userEdit(
        User $user,
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        $form = $this->createForm(AdminUserType::class, $user, ['is_edit' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allowed = ['ROLE_EMPLOYE', 'ROLE_VETERINAIRE'];
            $posted  = (array)$form->get('roles')->getData();
            $user->setRoles(array_values(array_intersect($posted, $allowed)));

            $plain = (string)$form->get('plainPassword')->getData();
            if ($plain !== '') {
                $user->setPassword($hasher->hashPassword($user, $plain));
            }

            $user->setEmail(strtolower(trim((string)$user->getEmail())));
            try { $em->flush(); }
            catch (UniqueConstraintViolationException) {
                $this->addFlash('error', 'Cet email est déjà utilisé.');
                return $this->redirectToRoute('admin_users_edit', ['id' => $user->getId()]);
            }

            $this->addFlash('success', 'Utilisateur mis à jour.');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/users/form.html.twig', [
            'form'  => $form,
            'title' => 'Modifier l’utilisateur',
        ]);
    }

    #[Route('/users/{id}/delete', name: 'admin_users_delete', methods: ['POST'])]
    public function userDelete(User $user, Request $request, EntityManagerInterface $em): Response
    {
        $this->isCsrfTokenValid('user_delete_'.$user->getId(), (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        if ($this->getUser()?->getUserIdentifier() === $user->getUserIdentifier()) {
            $this->addFlash('error', 'Vous ne pouvez pas supprimer votre propre compte.');
            return $this->redirectToRoute('admin_users');
        }

        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Utilisateur supprimé.');
        return $this->redirectToRoute('admin_users');
    }

    // ===================== Services =====================

    #[Route('/services/create', name: 'admin_service_create', methods: ['POST'])]
    public function serviceCreate(Request $request, EntityManagerInterface $em): Response
    {
        $this->isCsrfTokenValid('service_create', (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        $nom = trim((string)$request->request->get('nom'));
        $description = (string)$request->request->get('description');

        if ($nom === '') {
            $this->addFlash('error', 'Le nom du service est obligatoire.');
            return $this->redirectToRoute('app_admin');
        }

        $s = new Service();
        $s->setNom($nom);
        $s->setDescription($description ?: null);

        $em->persist($s);
        $em->flush();

        $this->addFlash('success', 'Service ajouté.');
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/services/update', name: 'admin_service_update', methods: ['POST'])]
    public function serviceUpdate(Request $request, ServiceRepository $repo, EntityManagerInterface $em): Response
    {
        $id = (int)$request->request->get('id');
        $service = $repo->find($id) ?? throw $this->createNotFoundException();

        $this->isCsrfTokenValid('service_edit_'.$service->getId(), (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        $nom = trim((string)$request->request->get('nom'));
        $description = (string)$request->request->get('description');

        if ($nom === '') {
            $this->addFlash('error', 'Le nom du service est obligatoire.');
            return $this->redirectToRoute('app_admin');
        }

        $service->setNom($nom);
        $service->setDescription($description ?: null);
        $em->flush();

        $this->addFlash('success', 'Service mis à jour.');
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/services/{id}/delete', name: 'admin_service_delete', methods: ['POST'])]
    public function serviceDelete(int $id, Request $request, ServiceRepository $repo, EntityManagerInterface $em): Response
    {
        $service = $repo->find($id) ?? throw $this->createNotFoundException();

        $this->isCsrfTokenValid('service_delete_'.$service->getId(), (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        $em->remove($service);
        $em->flush();

        $this->addFlash('success', 'Service supprimé.');
        return $this->redirectToRoute('app_admin');
    }

    // ===================== Habitats =====================

    #[Route('/habitats/create', name: 'admin_habitat_create', methods: ['POST'])]
    public function habitatCreate(Request $request, EntityManagerInterface $em): Response
    {
        $this->isCsrfTokenValid('habitat_create', (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        $nom = trim((string)$request->request->get('nom'));
        $description = (string)$request->request->get('description');

        if ($nom === '') {
            $this->addFlash('error', 'Le nom de l’habitat est obligatoire.');
            return $this->redirectToRoute('app_admin');
        }

        $h = new Habitat();
        $h->setNom($nom);
        $h->setDescription($description ?: null);

        $em->persist($h);
        $em->flush();

        $this->addFlash('success', 'Habitat ajouté.');
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/habitats/update', name: 'admin_habitat_update', methods: ['POST'])]
    public function habitatUpdate(Request $request, HabitatRepository $repo, EntityManagerInterface $em): Response
    {
        $id = (int)$request->request->get('id');
        $habitat = $repo->find($id) ?? throw $this->createNotFoundException();

        $this->isCsrfTokenValid('habitat_edit_'.$habitat->getId(), (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        $nom = trim((string)$request->request->get('nom'));
        $description = (string)$request->request->get('description');

        if ($nom === '') {
            $this->addFlash('error', 'Le nom de l’habitat est obligatoire.');
            return $this->redirectToRoute('app_admin');
        }

        $habitat->setNom($nom);
        $habitat->setDescription($description ?: null);
        $em->flush();

        $this->addFlash('success', 'Habitat mis à jour.');
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/habitats/{id}/delete', name: 'admin_habitat_delete', methods: ['POST'])]
    public function habitatDelete(int $id, Request $request, HabitatRepository $repo, EntityManagerInterface $em): Response
    {
        $habitat = $repo->find($id) ?? throw $this->createNotFoundException();

        $this->isCsrfTokenValid('habitat_delete_'.$habitat->getId(), (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        if ($habitat->getAnimals()->count() > 0) {
            $this->addFlash('error', 'Impossible de supprimer : des animaux sont rattachés à cet habitat.');
            return $this->redirectToRoute('app_admin');
        }

        $em->remove($habitat);
        $em->flush();

        $this->addFlash('success', 'Habitat supprimé.');
        return $this->redirectToRoute('app_admin');
    }

    // ===================== Animaux (sous-tableau des habitats) =====================

    #[Route('/animals/create', name: 'admin_animal_create', methods: ['POST'])]
    public function animalCreate(Request $request, EntityManagerInterface $em, HabitatRepository $habitatRepo): Response
    {
        $this->isCsrfTokenValid('animal_create', (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        $prenom = trim((string)$request->request->get('prenom'));
        $race   = trim((string)$request->request->get('race'));
        $habId  = (int)($request->request->get('habitat_id_override') ?: $request->request->get('habitat_id'));

        if ($prenom === '' || $race === '' || !$habId) {
            $this->addFlash('error', 'Prénom, race et habitat sont obligatoires.');
            return $this->redirectToRoute('app_admin');
        }

        $habitat = $habitatRepo->find($habId) ?? throw $this->createNotFoundException();

        $a = new Animal();
        $a->setPrenom($prenom);
        $a->setRace($race);
        $a->setHabitat($habitat);

        $em->persist($a);
        $em->flush();

        $this->addFlash('success', 'Animal ajouté.');
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/animals/update', name: 'admin_animal_update', methods: ['POST'])]
    public function animalUpdate(Request $request, AnimalRepository $animalRepo, HabitatRepository $habitatRepo, EntityManagerInterface $em): Response
    {
        $id = (int)$request->request->get('id');
        $animal = $animalRepo->find($id) ?? throw $this->createNotFoundException();

        $this->isCsrfTokenValid('animal_edit_'.$animal->getId(), (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        $prenom = trim((string)$request->request->get('prenom'));
        $race   = trim((string)$request->request->get('race'));
        $habId  = (int)$request->request->get('habitat_id');

        if ($prenom === '' || $race === '' || !$habId) {
            $this->addFlash('error', 'Prénom, race et habitat sont obligatoires.');
            return $this->redirectToRoute('app_admin');
        }

        $habitat = $habitatRepo->find($habId) ?? throw $this->createNotFoundException();

        $animal->setPrenom($prenom);
        $animal->setRace($race);
        $animal->setHabitat($habitat);

        $em->flush();

        $this->addFlash('success', 'Animal mis à jour.');
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/animals/{id}/delete', name: 'admin_animal_delete', methods: ['POST'])]
    public function animalDelete(int $id, Request $request, AnimalRepository $animalRepo, EntityManagerInterface $em): Response
    {
        $animal = $animalRepo->find($id) ?? throw $this->createNotFoundException();

        $this->isCsrfTokenValid('animal_delete_'.$animal->getId(), (string)$request->request->get('_token'))
            || throw $this->createAccessDeniedException();

        try {
            $em->remove($animal);
            $em->flush();
            $this->addFlash('success', 'Animal supprimé.');
        } catch (ForeignKeyConstraintViolationException) {
            $this->addFlash('error', 'Impossible de supprimer cet animal : des données liées existent.');
        }

        return $this->redirectToRoute('app_admin');
    }
}
