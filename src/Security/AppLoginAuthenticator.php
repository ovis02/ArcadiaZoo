<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AppLoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    {
        // Récupérer l'email soumis par le formulaire
        $email = $request->get('email', '');

        // Enregistrer l'email dans la session pour affichage en cas d'erreur
        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        // Création du passeport pour vérifier l'utilisateur et son mot de passe
        return new Passport(
            new UserBadge($email), // Vérifie que l'utilisateur existe
            new PasswordCredentials($request->get('password', '')), // Vérifie le mot de passe
            [
                new CsrfTokenBadge('authenticate', $request->get('_csrf_token')), // Vérifie le token CSRF
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Rediriger vers la dernière page visitée (si elle existe)
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // Récupérer les rôles de l'utilisateur connecté
        $roles = $token->getRoleNames();

        // Redirection selon les rôles
        if (in_array('ROLE_ADMIN', $roles)) {
            return new RedirectResponse($this->urlGenerator->generate('app_admin'));
        } elseif (in_array('ROLE_EMPLOYEE', $roles)) {
            return new RedirectResponse($this->urlGenerator->generate('app_employee'));
        } elseif (in_array('ROLE_VETERINARIAN', $roles)) {
            return new RedirectResponse($this->urlGenerator->generate('app_veterinarian'));
        }

        // Par défaut : rediriger vers la page d'accueil
        return new RedirectResponse($this->urlGenerator->generate('homepage'));
    }

    protected function getLoginUrl(Request $request): string
    {
        // Définir l'URL de connexion
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
