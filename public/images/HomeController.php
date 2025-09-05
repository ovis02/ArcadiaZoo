<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisFormType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setEstValide(false); // L'avis n'est pas validé par défaut
            $avis->setDateCreation(new \DateTime()); // Ajoute la date actuelle

            $entityManager->persist($avis);
            $entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(['status' => 'success', 'message' => 'Votre avis a été envoyé avec succès !']);
            }
        }

        // Récupérer uniquement les avis validés (est_valide = true) triés par date décroissante
        $avisValides = $entityManager->getRepository(Avis::class)->findBy(
            ['est_valide' => true], 
            ['date_creation' => 'DESC']
        );

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'avisValides' => $avisValides, // Envoi des avis validés au template
        ]);
    }
}
