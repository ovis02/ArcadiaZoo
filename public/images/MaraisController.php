<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MaraisController extends AbstractController
{
    
    private $habitatRepository;
    private $animalRepository;

    // Injection des repositories dans le constructeur
    public function __construct(HabitatRepository $habitatRepository, AnimalRepository $animalRepository)
    {
        $this->habitatRepository = $habitatRepository;
        $this->animalRepository = $animalRepository;
    }
    #[Route('/marais', name: 'app_marais')]
    public function index(): Response
    {
    // Récupérer l'habitat "Marais"
        $habitat = $this->habitatRepository->findOneBy(['titre' => 'Marais']);

        // Récupérer 5 animaux spécifiques de l'habitat Marais
        $animal1 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 16]);
        $animal2 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 17]);
        $animal3 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 18]);
        $animal4 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 19]);
        $animal5 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 20]);

        // Renvoyer à la vue avec l'habitat et les animaux spécifiques
        return $this->render('marais/index.html.twig', [
            'habitat' => $habitat,
            'animal1' => $animal1,
            'animal2' => $animal2,
            'animal3' => $animal3,
            'animal4' => $animal4,
            'animal5' => $animal5,
        ]);
    }
}
