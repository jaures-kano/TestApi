<?php

namespace App\Application\Auth\Authentificators;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
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
use Symfony\Component\Serializer\SerializerInterface;

class ApiAuthentificator extends AbstractAuthenticator
{
    private JWTTokenManagerInterface $jwt;

    private SerializerInterface $serializer;


    /**
     * @param JWTTokenManagerInterface $jwt
     * @param SerializerInterface $serializer
     */
    public function __construct(JWTTokenManagerInterface $jwt, SerializerInterface $serializer)
    {
        $this->jwt = $jwt;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return bool|null
     */
    public function supports(Request $request): ?bool
    {
        return true;
    }

    /**
     * @param Request $request
     * @return Passport
     */
    public function authenticate(Request $request): Passport
    {
        // Converts it into a PHP object
        $content = json_decode($request->getContent(), true);
        $request->getSession()->set(Security::LAST_USERNAME, $content['email']);

        return new Passport(
            new UserBadge($content['email']),
            new PasswordCredentials($content['password'])
        );
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $token->getUser();
        if ($token->getUser() !== null) {
            $token = $this->jwt->create($user);
            $json = $this->serializer->serialize([
                'message' => 'successfull login!',
                'user' => $user,
                'token' => $token,
            ], 'json', array_merge([
                'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
            ], ['groups' => 'read:user']));

            return new JsonResponse($json, 201, [], true);
        }

        // on success, let the request continue
        return null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'message' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }
}