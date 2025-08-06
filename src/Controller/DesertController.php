<?php

namespace App\Controller;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DesertController extends AbstractController
{
    #[Route('/desert', name: 'app_desert')]
    public function index(HabitatRepository $habitatRepository): Response
    {
        // 🔍 Récupération de l'habitat "Désert"
        $habitat = $habitatRepository->findOneBy(['nom' => 'Désert']);

        if (!$habitat) {
            throw $this->createNotFoundException('Habitat "Désert" non trouvé.');
        }

        //  Récupération des 5 premiers animaux liés à cet habitat via la relation
        $animaux = $habitat->getAnimals()->slice(0, 5);

        
        return $this->render('desert/index.html.twig', [
            'habitat' => $habitat,
            'animal1' => $animaux[0] ?? null,
            'animal2' => $animaux[1] ?? null,
            'animal3' => $animaux[2] ?? null,
            'animal4' => $animaux[3] ?? null,
            'animal5' => $animaux[4] ?? null,
        ]);
    }
}
