<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{
    #[Route('/formulaire', name: 'app_formulaire')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire de contact
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Contact $contact */
            $contact = $form->getData();

            // On complète les champs automatiques non présents dans le formulaire
            $contact->setDate(new \DateTime());
            $contact->setStatus("non lu");

            // Enregistrement en base
            $entityManager->persist($contact);
            $entityManager->flush();

            // Réponse AJAX en JSON (succès)
            return $this->json([
                'status' => 'success',
                'message' => 'Votre message a été envoyé avec succès.'
            ]);
        }

        // Si le formulaire est soumis mais non valide
        if ($form->isSubmitted()) {
            return $this->json([
                'status' => 'error',
                'message' => 'Des erreurs sont survenues, veuillez vérifier vos informations.'
            ]);
        }

        // Affichage initial (si pas de requête AJAX ou accès direct à la page)
        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
