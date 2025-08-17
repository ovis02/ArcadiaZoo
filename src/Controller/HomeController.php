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
    #[Route('/', name: 'app_home', methods: ['GET','POST'])]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $avis = new Avis(); // ->valide est NULL par défaut (tri-état)
        $form = $this->createForm(AvisFormType::class, $avis);
        $form->handleRequest($request);

        // Soumission AJAX
        if ($request->isXmlHttpRequest()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $avis->setDate(new \DateTime());      // ou new \DateTimeImmutable()
                // NE PAS toucher à $avis->setValide(...) -> reste NULL (à modérer)
                $em->persist($avis);
                $em->flush();

                return new JsonResponse([
                    'ok'      => true,
                    'message' => 'Merci pour votre avis ! Il sera visible après validation.'
                ]);
            }

            return new JsonResponse([
                'ok'      => false,
                'message' => 'Formulaire invalide. Merci de vérifier les champs.'
            ], 422);
        }

        // Soumission classique
        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setDate(new \DateTime());
            // NE PAS toucher à $avis->setValide(...) -> reste NULL (à modérer)
            $em->persist($avis);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre avis ! Il sera visible après validation.');
            return $this->redirectToRoute('app_home');
        }

        // Affichage des avis validés uniquement
        $avisValides = $em->getRepository(Avis::class)
            ->findBy(['valide' => true], ['date' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'form'        => $form->createView(),
            'avisValides' => $avisValides,
        ]);
    }
}
