<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JungleController extends AbstractController
{
    
    private $habitatRepository;
    private $animalRepository;

    // Injection des repositories dans le constructeur
    public function __construct(HabitatRepository $habitatRepository, AnimalRepository $animalRepository)
    {
        $this->habitatRepository = $habitatRepository;
        $this->animalRepository = $animalRepository;
    }
    #[Route('/jungle', name: 'app_jungle')]
    public function index(): Response
    {
         // Récupérer l'habitat "Désert"
        $habitat = $this->habitatRepository->findOneBy(['titre' => 'Jungle']);

        // Récupérer 5 animaux spécifiques de l'habitat Désert
        $animal1 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 6]);
        $animal2 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 7]);
        $animal3 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 8]);
        $animal4 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 9]);
        $animal5 = $this->animalRepository->findOneBy(['habitat' => $habitat, 'id' => 10]);

        // Renvoyer à la vue avec l'habitat et les animaux spécifiques
        return $this->render('jungle/index.html.twig', [
            'habitat' => $habitat,
            'animal1' => $animal1,
            'animal2' => $animal2,
            'animal3' => $animal3,
            'animal4' => $animal4,
            'animal5' => $animal5,
        ]);
    }
}
