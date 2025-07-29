<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SavaneController extends AbstractController
{
        private $habitatRepository;
    private $animalRepository;

    // Injection des repositories dans le constructeur
    public function __construct(HabitatRepository $habitatRepository, AnimalRepository $animalRepository)
    {
        $this->habitatRepository = $habitatRepository;
        $this->animalRepository = $animalRepository;
    }
    #[Route('/savane', name: 'app_savane')]
    public function index(): Response
    {
      // Récupérer l'habitat "Savane"
        $habitat = $this->habitatRepository->findOneBy(['titre' => 'Savane']);

        // Récupérer 5 animaux spécifiques de l'habitat Marais
        $animal1 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 21]);
        $animal2 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 22]);
        $animal3 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 23]);
        $animal4 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 24]);
        $animal5 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 25]);
        $animal6 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 26]);
        $animal7 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 27]);

        // Renvoyer à la vue avec l'habitat et les animaux spécifiques
        return $this->render('savane/index.html.twig', [
           'habitat' => $habitat,
            'animal1' => $animal1,
            'animal2' => $animal2,
            'animal3' => $animal3,
            'animal4' => $animal4,
            'animal5' => $animal5,
            'animal6' => $animal6,
            'animal7' => $animal7,

        ]);
    }
}
