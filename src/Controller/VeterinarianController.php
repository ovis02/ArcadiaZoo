<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeterinarianController extends AbstractController
{
    #[Route('/veterinarian', name: 'app_veterinarian')]
    public function index(AnimalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findAll(); // Récupère tous les animaux
        return $this->render('veterinarian/index.html.twig', [
            'animals' => $animals,
        ]);
    }

    #[Route('/veterinarian/update/{id}', name: 'app_veterinarian_update', methods: ['POST'])]
    public function updateAnimal(int $id, Request $request, AnimalRepository $animalRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Récupérer l'animal par son ID
        $animal = $animalRepository->find($id);
        if (!$animal) {
            return new JsonResponse(['message' => 'Animal introuvable'], Response::HTTP_NOT_FOUND);
        }

        // Mettre à jour les données de l'animal
        $animal->setEtatAnimal($data['etat']);
        $animal->setNourritureProposee($data['nourriture']);
        $animal->setGrammageNourriture((int) $data['grammage']);
        $animal->setDatePassage(new \DateTime($data['date']));

        // Sauvegarder les modifications
        $entityManager->persist($animal);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Animal mis à jour avec succès.']);
    }

    #[Route('/veterinarian/delete/{id}', name: 'app_veterinarian_delete', methods: ['DELETE'])]
    public function deleteAnimal(int $id, AnimalRepository $animalRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupérer l'animal par son ID
        $animal = $animalRepository->find($id);
        if (!$animal) {
            return new JsonResponse(['message' => 'Animal introuvable'], Response::HTTP_NOT_FOUND);
        }

        // Supprimer l'animal
        $entityManager->remove($animal);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Animal supprimé avec succès.']);
    }
}
