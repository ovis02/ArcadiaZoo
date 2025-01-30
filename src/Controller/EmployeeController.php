<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'app_employee')]
    public function index(AvisRepository $avisRepository): Response
    {
        $avisList = $avisRepository->findAll();

        return $this->render('employee/index.html.twig', [
            'avisList' => $avisList, 
        ]);
    }

    #[Route('/employee/valider-avis/{id}', name: 'valider_avis', methods: ['PATCH'])]
    public function validerAvis(Avis $avis, EntityManagerInterface $entityManager): JsonResponse
    {
        // Vérifier si l'avis est déjà validé
        if ($avis->isEstValide()) {
            return new JsonResponse(['success' => false, 'message' => "L'avis est déjà validé"], 400);
        }

        // Valider l'avis
        $avis->setEstValide(true);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => "L'avis a été validé"]);
    }

    #[Route('/employee/supprimer-avis/{id}', name: 'supprimer_avis', methods: ['DELETE'])]
    public function supprimerAvis(Avis $avis, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($avis);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => "L'avis a été supprimé"]);
    }
}
