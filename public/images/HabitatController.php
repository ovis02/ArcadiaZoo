<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnimalsRepository;

class HabitatController extends AbstractController
{
    #[Route('/habitat/{slug}', name: 'app_habitat')]
    public function show(string $slug, AnimalsRepository $animalRepository): Response
    {
        // Récupérer les animaux associés à l'habitat spécifié par le slug
        $animals = $animalRepository->findBy(['habitat' => $slug]); // Utilisation du slug pour trouver les animaux par habitat

        // Vérifier si des animaux existent
        if (!$animals) {
            throw $this->createNotFoundException('Aucun animal trouvé pour cet habitat.');
        }

        // Rendre la vue avec les animaux de l'habitat spécifié
        return $this->render('habitat/show.html.twig', [
            'animals' => $animals,
        ]);
    }
}


