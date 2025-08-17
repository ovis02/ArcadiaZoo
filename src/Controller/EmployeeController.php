<?php
// src/Controller/EmployeController.php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Animal;
use App\Entity\Repas;
use App\Entity\Contact;
use App\Entity\Service;
use App\Repository\AvisRepository;
use App\Repository\AnimalRepository;
use App\Repository\RepasRepository;
use App\Repository\ContactRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_EMPLOYE')]
#[Route('/employee')]
class EmployeeController extends AbstractController
{
    #[Route('', name: 'app_employee', methods: ['GET'])]
    public function index(
        AvisRepository $avisRepo,
        RepasRepository $repasRepo,
        AnimalRepository $animalRepo,
        ContactRepository $contactRepo,
        ServiceRepository $serviceRepo
    ): Response {
        // --- Avis (tri-état)
        $avisEnAttente = $avisRepo->createQueryBuilder('a')
            ->andWhere('a.valide IS NULL')
            ->orderBy('a.date', 'DESC')
            ->getQuery()->getResult();

        $avisInvalides = $avisRepo->findBy(['valide' => false], ['date' => 'DESC']);
        $avisValides   = $avisRepo->findBy(['valide' => true],  ['date' => 'DESC']);

        // --- Repas
        $animaux      = $animalRepo->findBy([], ['prenom' => 'ASC']);
        $repasRecents = $repasRepo->findBy([], ['dateHeure' => 'DESC'], 20);

        // --- Contacts
        $contactsEnAttente = $contactRepo->findBy(['status' => 'EN_ATTENTE'], ['date' => 'DESC']);
        $contactsTraites   = $contactRepo->findBy(['status' => 'TRAITE'], ['date' => 'DESC']);

        // --- Services
        $services = $serviceRepo->findBy([], ['id' => 'ASC']);

        return $this->render('employee/index.html.twig', [
            'avisEnAttente'     => $avisEnAttente,
            'avisInvalides'     => $avisInvalides,
            'avisValides'       => $avisValides,
            'animaux'           => $animaux,
            'repasRecents'      => $repasRecents,
            'contactsEnAttente' => $contactsEnAttente,
            'contactsTraites'   => $contactsTraites,
            'services'          => $services,
        ]);
    }

    #[Route('/avis/{id}/{action}', name: 'employee_avis_moderate', requirements: ['action' => 'valider|invalider'], methods: ['POST'])]
    public function moderateAvis(Avis $avis, string $action, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('moderate_avis_'.$avis->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        $avis->setValide($action === 'valider');
        $avis->setValidePar($this->getUser());
        $em->flush();

        $this->addFlash('success', $action === 'valider' ? 'Avis validé.' : 'Avis invalidé.');
        return $this->redirectToRoute('app_employee');
    }

    #[Route('/repas/add', name: 'employee_repas_add', methods: ['POST'])]
    public function addRepas(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('repas_add', $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        $animalId = (int) $request->request->get('animal_id');
        /** @var Animal|null $animal */
        $animal = $em->getRepository(Animal::class)->find($animalId);
        if (!$animal) {
            $this->addFlash('error', 'Animal introuvable.');
            return $this->redirectToRoute('app_employee');
        }

        $nourriture = trim((string) $request->request->get('nourriture'));
        $quantite   = (float) $request->request->get('quantite');
        $dateStr    = $request->request->get('dateHeure');

        if ($nourriture === '' || $quantite <= 0 || !$dateStr) {
            $this->addFlash('error', 'Veuillez renseigner la nourriture, la quantité (>0) et la date/heure.');
            return $this->redirectToRoute('app_employee');
        }

        $repas = (new Repas())
            ->setAnimal($animal)
            ->setNourritureDonnee($nourriture)
            ->setQuantite($quantite)
            ->setDateHeure(new \DateTime($dateStr))
            ->setAjoutePar($this->getUser());

        $em->persist($repas);
        $em->flush();

        $this->addFlash('success', 'Repas enregistré.');
        return $this->redirectToRoute('app_employee');
    }

    #[Route('/repas/{id}/delete', name: 'employee_repas_delete', methods: ['POST'])]
    public function deleteRepas(Repas $repas, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('repas_delete_'.$repas->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        $em->remove($repas);
        $em->flush();

        $this->addFlash('success', 'Repas supprimé.');
        return $this->redirectToRoute('app_employee');
    }

    // =======================
    //   CONTACTS — ACTIONS
    // =======================

    #[Route('/contacts/{id}/resolve', name: 'employee_contact_resolve', methods: ['POST'])]
    public function resolveContact(Contact $contact, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('contact_resolve_'.$contact->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        $contact->setStatus('TRAITE');
        $contact->setTraitePar($this->getUser());
        $em->flush();

        $this->addFlash('success', 'Message marqué comme traité.');
        return $this->redirectToRoute('app_employee');
    }

    #[Route('/contacts/{id}/reopen', name: 'employee_contact_reopen', methods: ['POST'])]
    public function reopenContact(Contact $contact, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('contact_reopen_'.$contact->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        $contact->setStatus('EN_ATTENTE');
        $contact->setTraitePar(null);
        $em->flush();

        $this->addFlash('success', 'Message remis en attente.');
        return $this->redirectToRoute('app_employee');
    }

    #[Route('/contacts/{id}/delete', name: 'employee_contact_delete', methods: ['POST'])]
    public function deleteContact(Contact $contact, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('contact_delete_'.$contact->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        $em->remove($contact);
        $em->flush();

        $this->addFlash('success', 'Message supprimé.');
        return $this->redirectToRoute('app_employee');
    }

    // =======================
    //   SERVICES — ACTIONS
    // =======================

    /** Édition par route RESTful /services/{id}/edit (si tu l'utilises encore) */
    #[Route('/services/{id}/edit', name: 'employee_service_edit', methods: ['POST'])]
    public function editService(Service $service, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('service_edit_'.$service->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        $nom = trim((string) $request->request->get('nom'));
        $description = trim((string) $request->request->get('description'));

        if ($nom === '') {
            $this->addFlash('error', 'Le nom du service est obligatoire.');
            return $this->redirectToRoute('app_employee');
        }

        $service->setNom($nom);
        $service->setDescription($description);
        $em->flush();

        $this->addFlash('success', 'Service mis à jour.');
        return $this->redirectToRoute('app_employee');
    }

    /** Édition utilisée par le formulaire inline (id caché) */
    #[Route('/services/update', name: 'employee_service_update', methods: ['POST'])]
    public function updateService(Request $request, EntityManagerInterface $em, ServiceRepository $serviceRepo): Response
    {
        $id    = (int) $request->request->get('id');
        $token = (string) $request->request->get('_token');

        if (!$id || !$this->isCsrfTokenValid('service_edit_'.$id, $token)) {
            $this->addFlash('error', 'Token CSRF invalide ou identifiant manquant.');
            return $this->redirectToRoute('app_employee');
        }

        $service = $serviceRepo->find($id);
        if (!$service) {
            $this->addFlash('error', 'Service introuvable.');
            return $this->redirectToRoute('app_employee');
        }

        $nom = trim((string) $request->request->get('nom'));
        $description = trim((string) $request->request->get('description'));

        if ($nom === '') {
            $this->addFlash('error', 'Le nom du service est obligatoire.');
            return $this->redirectToRoute('app_employee');
        }

        $service->setNom($nom);
        $service->setDescription($description);
        $em->flush();

        $this->addFlash('success', 'Service mis à jour.');
        return $this->redirectToRoute('app_employee');
    }

    #[Route('/services/{id}/delete', name: 'employee_service_delete', methods: ['POST'])]
    public function deleteService(Service $service, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('service_delete_'.$service->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_employee');
        }

        try {
            $em->remove($service);
            $em->flush();
            $this->addFlash('success', 'Service supprimé.');
        } catch (\Throwable $e) {
            $this->addFlash('error', 'Suppression impossible : le service est peut-être référencé ailleurs.');
        }

        return $this->redirectToRoute('app_employee');
    }
}
