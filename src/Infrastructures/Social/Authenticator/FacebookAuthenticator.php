<?php

namespace App\Infrastructures\Social\Authenticator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class FacebookAuthenticator extends AbstractAuthenticator
{
    private $entityManager;
    private $router;

    public function __construct(EntityManagerInterface $entityManager, RouterInterface $router)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    public function supports(Request $request): ?bool
    {
        $content = json_decode($request->getContent(), true);
        if ($content === null) {
            return false;
        }

        return $request->getContentType() === 'json'
            && $request->isMethod('POST')
            && $request->attributes->get('service') === 'facebook'
            && $request->attributes->get('_route') === 'api_auth_registration_social';
    }

    public function authenticate(Request $request): Passport
    {
        $content = json_decode($request->getContent(), true);

        return new SelfValidatingPassport(
            new UserBadge($content['username'])
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $content = json_decode($request->getContent(), true);

        if ($token->getUser()->getFacebookId() !== $content['account_id']) {
            return new JsonResponse([
                'message' => 'Social auth don\'t work'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'message' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }
}
