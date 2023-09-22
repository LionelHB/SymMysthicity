<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, SessionInterface $session): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
    
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    // #[Route(path: '/logout', name: 'app_logout')]
    // public function logout(): void
    // {
    //     throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    // }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(Request $request, TokenStorageInterface $tokenStorage, LogoutSuccessHandlerInterface $logoutSuccessHandler): JsonResponse
    {
        
        // Déconnectez l'utilisateur
        $token = $tokenStorage->getToken();
        if ($token instanceof TokenInterface) {
            $this->get('security.token_storage')->setToken(null);
            $request->getSession()->invalidate();
        }
    
        return $logoutSuccessHandler->onLogoutSuccess($request);
    }



    #[Route(path: '/api/login_check', name: 'login_check')]
    public function checkAuth(Security $security): JsonResponse
    {
        // Vérifiez ici si l'utilisateur est authentifié
        if (!$security->isGranted('ROLE_USER')) {
            return new JsonResponse(['message' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
        }
    
        return new JsonResponse(['message' => 'Authenticated'], JsonResponse::HTTP_OK);
    }
}
