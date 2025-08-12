<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // 🔹 Si déjà connecté → redirection directe selon le rôle
        if ($this->getUser()) {
            $roles = $this->getUser()->getRoles();

            if (in_array('ROLE_ADMIN', $roles, true)) {
                return $this->redirectToRoute('app_admin');
            } elseif (in_array('ROLE_EMPLOYE', $roles, true)) {
                return $this->redirectToRoute('app_employee');
            } elseif (in_array('ROLE_VETERINAIRE', $roles, true)) {
                return $this->redirectToRoute('app_veterinarian');
            }

            // Fallback si aucun rôle spécifique
            return $this->redirectToRoute('app_home');
        }

        // 🔹 Récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();

        // 🔹 Récupère le dernier email saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        // 🔹 Affiche la page de connexion
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Symfony gère la déconnexion automatiquement via security.yaml
        throw new \LogicException('Cette méthode peut rester vide, Symfony gère la déconnexion.');
    }
}
