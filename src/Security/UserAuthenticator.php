<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class UserAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    private $urlGenerator;
    private $userRepository;
    private $security;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        UserRepository $userRepository,
        Security $security
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->userRepository = $userRepository;
        $this->security = $security;
    }

    public function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }

    public function authenticate(Request $request): Passport
    {
        $emailOrName = $request->request->get('email', '');
    
        return new Passport(
            new UserBadge($emailOrName, function ($userIdentifier) {
                return $this->userRepository->findByEmailOrName($userIdentifier);
            }),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }
    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            // Redirect to the originally requested page (if available)
            return new RedirectResponse($targetPath);
        }
    
        // Redirect to a default page after successful authentication
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }
    

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        // Check if user is not authenticated and the requested path is not the login page
        if (!$this->security->getUser() && $request->getPathInfo() !== '/login') {
            // Redirect to the login page
            $url = $this->urlGenerator->generate(self::LOGIN_ROUTE);
            $event->setResponse(new RedirectResponse($url));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
