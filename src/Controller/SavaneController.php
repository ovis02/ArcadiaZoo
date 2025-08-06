<?php

namespace App\Controller;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SavaneController extends AbstractController
{
    #[Route('/savane', name: 'app_savane')]
    public function index(HabitatRepository $habitatRepository): Response
    {
        $habitat = $habitatRepository->findOneBy(['nom' => 'Savane']);

        if (!$habitat) {
            throw $this->createNotFoundException('Habitat "Savane" non trouvé.');
        }

        $animaux = $habitat->getAnimals()->slice(0, 7);

        return $this->render('savane/index.html.twig', [
            'habitat' => $habitat,
            'animal1' => $animaux[0] ?? null,
            'animal2' => $animaux[1] ?? null,
            'animal3' => $animaux[2] ?? null,
            'animal4' => $animaux[3] ?? null,
            'animal5' => $animaux[4] ?? null,
            'animal6' => $animaux[5] ?? null,
            'animal7' => $animaux[6] ?? null,
        ]);
    }
}
