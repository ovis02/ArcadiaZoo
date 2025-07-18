<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeterinarianController extends AbstractController
{
    #[Route('/veterinarian', name: 'app_veterinarian')]
    public function index(): Response
    {
        return $this->render('veterinarian/index.html.twig');
    }
}
