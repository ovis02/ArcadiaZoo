<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisFormType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setDate(new \DateTime());
            $avis->setValide(false); // Par défaut, l'avis n'est pas encore validé
            $em->persist($avis);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre avis ! Il sera visible après validation.');
            return $this->redirectToRoute('app_home');
        }

        // Récupérer les avis validés
        $avisValides = $em->getRepository(Avis::class)->findBy(['valide' => true], ['date' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'avisValides' => $avisValides,
        ]);
    }
}
