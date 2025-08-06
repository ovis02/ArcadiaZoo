<?php

namespace App\Controller;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaraisController extends AbstractController
{
    #[Route('/marais', name: 'app_marais')]
    public function index(HabitatRepository $habitatRepository): Response
    {
        $habitat = $habitatRepository->findOneBy(['nom' => 'Marais']);

        if (!$habitat) {
            throw $this->createNotFoundException('Habitat "Marais" non trouvé.');
        }

        $animaux = $habitat->getAnimals()->slice(0, 5);

        return $this->render('marais/index.html.twig', [
            'habitat' => $habitat,
            'animal1' => $animaux[0] ?? null,
            'animal2' => $animaux[1] ?? null,
            'animal3' => $animaux[2] ?? null,
            'animal4' => $animaux[3] ?? null,
            'animal5' => $animaux[4] ?? null,
        ]);
    }
}
