<?php

namespace App\Application\Authentification\Auth\Authentificators;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class ApiAuthentificator extends AbstractAuthenticator
{
    public function supports(Request $request): ?bool
    {
        $content = json_decode($request->getContent(), true);
        if ($content === null) {
            return false;
        }

        return $request->getContentType() === 'json'
            && $request->isMethod('POST')
            && $request->attributes->get('_route') === 'api_authentification_login';
    }

    public function authenticate(Request $request): Passport
    {
        // Converts it into a PHP object
        $content = json_decode($request->getContent(), true);
        $request->getSession()->set(Security::LAST_USERNAME, $content['username']);

        return new Passport(
            new UserBadge($content['username']),
            new PasswordCredentials($content['password'])
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // on success, let the request continue
        if ($token->getUser()->isActived() === false) {
            $token->setAuthenticated(false);
            return new JsonResponse([
                'message' => 'The user account is not yet activated'
            ], Response::HTTP_UPGRADE_REQUIRED);
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