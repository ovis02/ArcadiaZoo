<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\CompteRenduVeterinaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_VETERINAIRE')]
class VeterinarianController extends AbstractController
{
    #[Route('/veterinaire', name: 'app_veterinarian', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        // Liste des animaux triés par prénom pour l’interface vétérinaire
        $animaux = $em->getRepository(Animal::class)->findBy([], ['prenom' => 'ASC']);

        return $this->render('veterinarian/index.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    #[Route('/veterinaire/animal/{id}/update', name: 'app_veterinarian_update', methods: ['POST'])]
    public function update(Animal $animal, Request $request, EntityManagerInterface $em): Response
    {
        // Sécurité CSRF
        if (!$this->isCsrfTokenValid('vet_update_' . $animal->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_veterinarian');
        }

        // Données du formulaire
        $etat = $request->request->get('etat');            // string|null
        $nour = $request->request->get('nourriture');      // string|null
        $gram = $request->request->get('grammage');        // number|string|null
        $date = $request->request->get('date');            // 'YYYY-MM-DD' ou ''
        $com  = $request->request->get('commentaire');     // string|null

        // --- 1) Mise à jour de la fiche ANIMAL (instantané public) ---
        // État
        if ($etat !== null && $etat !== '') {
            $animal->setEtat($etat);
        }

        // Consignes d’alimentation (proposées par la véto)
        $animal->setNourritureProposee($nour ?: null);

        // Grammage recommandé (null si vide)
        $animal->setGrammage($gram !== null && $gram !== '' ? (float) $gram : null);

        // Date du dernier passage de la véto
        if ($date) {
            try {
                $animal->setDateDernierPassage(new \DateTimeImmutable($date));
            } catch (\Exception $e) {
                $this->addFlash('error', 'Date invalide.');
                return $this->redirectToRoute('app_veterinarian');
            }
        }

        // ✅ Dénormalisation : commentaire véto recopié sur l’animal
        $animal->setCommentaire($com ?: null);

        // --- 2) Historique : création du COMPTE-RENDU VÉTÉRINAIRE ---
        $cr = new CompteRenduVeterinaire();
        $cr->setEtat($etat ?? ($animal->getEtat() ?? ''));
        $cr->setNourriture($nour ?: null);
        $cr->setGrammage($gram !== null && $gram !== '' ? (float) $gram : null);
        $cr->setDate($date ? new \DateTimeImmutable($date) : new \DateTimeImmutable());
        $cr->setCommentaire($com ?: null);
        $cr->setAnimal($animal);
        $cr->setVeterinaire($this->getUser());

        $em->persist($cr);

        // Un seul flush suffit : il enregistrera à la fois le CR et l’animal modifié
        $em->flush();

        $this->addFlash('success', 'Compte-rendu enregistré et fiche animal mise à jour.');
        return $this->redirectToRoute('app_veterinarian');
    }
}
