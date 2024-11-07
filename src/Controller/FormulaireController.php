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
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Création d'un nouvel objet Contact
            $contact = new Contact();
            $contact->setEmail($form->get('email')->getData());
            $contact->setMotif($form->get('motif')->getData());
            $contact->setDescription($form->get('description')->getData());

            // Enregistrement des données dans la base de données
            $entityManager->persist($contact);
            $entityManager->flush();

            // Retourner une réponse JSON pour indiquer que l'envoi a réussi
            return $this->json([
                'status' => 'success',
                'message' => 'Votre message a été envoyé avec succès.'
            ]);
        }

        // Si le formulaire n'est pas valide, retourner une réponse JSON d'erreur
        if ($form->isSubmitted()) {
            return $this->json([
                'status' => 'error',
                'message' => 'Des erreurs sont survenues, veuillez vérifier vos informations.'
            ]);
        }

        // Retourne la vue du formulaire si aucune soumission n'a été faite
        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}