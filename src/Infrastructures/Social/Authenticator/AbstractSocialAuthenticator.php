<?php

namespace App\Infrastructures\Social\Authenticator;

use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Infrastructure\Social\Exception\UserAuthenticatedException;
use App\Infrastructure\Social\Exception\UserOauthNotFoundException;
use App\Infrastructures\Social\AuthService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\OAuth2ClientInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

abstract class AbstractSocialAuthenticator extends OAuth2Authenticator
{
    use TargetPathTrait;

    public EntityManagerInterface $em;
    protected string $serviceName = '';
    private ClientRegistry $clientRegistry;
    private RouterInterface $router;
    private AuthService $authService;

    public function __construct(
        ClientRegistry         $clientRegistry,
        EntityManagerInterface $em,
        RouterInterface        $router,
        AuthService            $authService
    )
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
        $this->authService = $authService;
    }

    public function supports(Request $request): bool
    {
        if ('' === $this->serviceName) {
            throw new Exception("You must set a \$serviceName property (for instance 'github', 'facebook')");
        }

        return 'oauth_check' === $request->attributes->get('_route') && $request->get('service') === $this->serviceName;
    }

    public function start(Request $request, AuthenticationException $authException = null): RedirectResponse
    {
        return new RedirectResponse($this->router->generate('auth_login'));
    }

    public function getCredentials(Request $request): AccessTokenInterface
    {
        return $this->fetchAccessToken($this->getClient());
    }

    protected function getClient(): OAuth2ClientInterface
    {
        return $this->clientRegistry->getClient($this->serviceName);
    }

    public function authenticate(Request $request): Passport
    {
        $client = $this->getClient();
        try {
            $accessToken = $client->getAccessToken();
        } catch (Exception) {
            throw new CustomUserMessageAuthenticationException(
                sprintf("Une erreur est survenue lors de la récupération du token d'accès %s", $this->serviceName)
            );
        }

        try {
            $resourceOwner = $this->getResourceOwnerFromCredentials($accessToken);
        } catch (Exception) {
            throw new CustomUserMessageAuthenticationException(
                sprintf("Une erreur est survenue lors de la communication avec %s", $this->serviceName)
            );
        }
        $user = $this->authService->getUserOrNull();
        if ($user) {
            throw new UserAuthenticatedException($user, $resourceOwner);
        }
        /** @var UserRepository $repository */
        $repository = $this->em->getRepository(User::class);
        $user = $this->getUserFromResourceOwner($resourceOwner, $repository);
        if (null === $user) {
            throw new UserOauthNotFoundException($resourceOwner);
        }

        $userLoader = fn() => $user;

        return new SelfValidatingPassport(
            new UserBadge($user->getUserIdentifier(), $userLoader)
        );
    }

    protected function getResourceOwnerFromCredentials(AccessToken $credentials): ResourceOwnerInterface
    {
        return $this->getClient()->fetchUserFromToken($credentials);
    }

    protected function getUserFromResourceOwner(
        ResourceOwnerInterface $resourceOwner,
        UserRepository         $repository
    ): ?User
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): RedirectResponse
    {
        if ($exception instanceof UserOauthNotFoundException) {
            return new RedirectResponse($this->router->generate('register', ['oauth' => 1]));
        }

        if ($exception instanceof UserAuthenticatedException) {
            return new RedirectResponse($this->router->generate('user_edit'));
        }

        if ($request->hasSession()) {
            $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        }

        return new RedirectResponse($this->router->generate('auth_login'));
    }

    public function onAuthenticationSuccess(
        Request        $request,
        TokenInterface $token,
        string         $firewallName
    ): RedirectResponse
    {
        // On force le remember me pour déclencher le AbstractRememberMeServices (en attendant mieux)
        $request->request->set('_remember_me', '1');

        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->router->generate('home'));
    }
}
