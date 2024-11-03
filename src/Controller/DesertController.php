<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DesertController extends AbstractController
{
    #[Route('/desert', name: 'app_desert')]
    public function index(): Response
    {
        return $this->render('desert/index.html.twig', [
            'controller_name' => 'DesertController',
        ]);
    }
}
