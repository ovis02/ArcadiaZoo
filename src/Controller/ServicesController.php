<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services', methods: ['GET'])]
    public function index(ServiceRepository $repo): Response
    {
        $services = $repo->findBy([], ['nom' => 'ASC']);

        $byName = [];
        foreach ($services as $s) {
            $byName[$s->getNom()] = $s;
        }

        return $this->render('services/index.html.twig', [
            'billetterie'   => $byName['Billetterie']      ?? null,
            'accesHoraires' => $byName['Accès & Horaires'] ?? null,
            'petitTrain'    => $byName['Le petit train']   ?? null,
            'guide'         => $byName['Guide']            ?? null,
            'restauration'  => $byName['Restauration']     ?? null,
        ]);
    }
}
