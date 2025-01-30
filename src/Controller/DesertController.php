<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DesertController extends AbstractController
{
    private $habitatRepository;
    private $animalRepository;

    // Injection des repositories dans le constructeur
    public function __construct(HabitatRepository $habitatRepository, AnimalRepository $animalRepository)
    {
        $this->habitatRepository = $habitatRepository;
        $this->animalRepository = $animalRepository;
    }

    #[Route('/desert', name: 'app_desert')]
    public function index(): Response
    {
        // Récupérer l'habitat "Désert"
        $habitat = $this->habitatRepository->findOneBy(['titre' => 'Désert']);

        // Récupérer 5 animaux spécifiques de l'habitat Désert
        $animal1 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 1]);
        $animal2 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 2]);
        $animal3 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 3]);
        $animal4 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 4]);
        $animal5 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 5]);

        // Renvoyer à la vue avec l'habitat et les animaux spécifiques
        return $this->render('desert/index.html.twig', [
            'habitat' => $habitat,
            'animal1' => $animal1,
            'animal2' => $animal2,
            'animal3' => $animal3,
            'animal4' => $animal4,
            'animal5' => $animal5,
        ]);
    }
}
