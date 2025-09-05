<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MountainController extends AbstractController
{
     private $habitatRepository;
    private $animalRepository;

    // Injection des repositories dans le constructeur
    public function __construct(HabitatRepository $habitatRepository, AnimalRepository $animalRepository)
    {
        $this->habitatRepository = $habitatRepository;
        $this->animalRepository = $animalRepository;
    }
    #[Route('/mountain', name: 'app_mountain')]
    public function index(): Response
    {
      // Récupérer l'habitat "Montagne"
        $habitat = $this->habitatRepository->findOneBy(['titre' => 'Montagne']);

        // Récupérer 5 animaux spécifiques de l'habitat Mountain
        $animal1 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 11]);
        $animal2 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 12]);
        $animal3 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 13]);
        $animal4 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 14]);
        $animal5 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 15]);

        // Renvoyer à la vue avec l'habitat et les animaux spécifiques
        return $this->render('mountain/index.html.twig', [
            'habitat' => $habitat,
            'animal1' => $animal1,
            'animal2' => $animal2,
            'animal3' => $animal3,
            'animal4' => $animal4,
            'animal5' => $animal5,
        ]);
    }
}
