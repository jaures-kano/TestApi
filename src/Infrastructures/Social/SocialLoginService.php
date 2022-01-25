<?php

namespace App\Infrastructures\Social;

use App\Domain\AuthDomain\Auth\Entity\User;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SocialLoginService
{
    public const SESSION_KEY = 'oauth_login';
    private RequestStack $requestStack;
    private NormalizerInterface $normalizer;
    private SessionInterface $session;

    public function __construct(
        RequestStack        $requestStack,
        NormalizerInterface $normalizer,
        SessionInterface    $session
    )
    {
        $this->requestStack = $requestStack;
        $this->normalizer = $normalizer;
        $this->session = $session;
    }

    public function persist(ResourceOwnerInterface $resourceOwner): void
    {
        $data = $this->normalizer->normalize($resourceOwner);
        $this->session->set(self::SESSION_KEY, $data);
    }

    public function hydrate(User $user): bool
    {
        $oauthData = $this->requestStack->getSession()->get(self::SESSION_KEY);
        if (null === $oauthData || !isset($oauthData['email'])) {
            return false;
        }
        $user->setEmail($oauthData['email']);
        $user->setGoogleId($oauthData['google_id'] ?? null);
        $user->setFacebookId($oauthData['facebook_id'] ?? null);
        $user->setConfirmationToken(null);

        return true;
    }

    public function getOauthType(): ?string
    {
        $oauthData = $this->requestStack->getSession()->get(self::SESSION_KEY);

        return $oauthData ? $oauthData['type'] : null;
    }
}
