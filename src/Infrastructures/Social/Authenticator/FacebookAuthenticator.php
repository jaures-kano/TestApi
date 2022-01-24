<?php

namespace App\Infrastructures\Social\Authenticator;

use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Infrastructure\Social\Exception\EmailAlreadyUsedException;
use League\OAuth2\Client\Provider\FacebookUser;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use RuntimeException;

class FacebookAuthenticator extends AbstractSocialAuthenticator
{
    protected string $serviceName = 'facebook';

    public function getUserFromResourceOwner(ResourceOwnerInterface $facebookUser, UserRepository $repository): ?User
    {
        if (!($facebookUser instanceof FacebookUser)) {
            throw new RuntimeException('Expecting FacebookClient as the first parameter');
        }
        $user = $repository->findForOauth('facebook', $facebookUser->getId(), $facebookUser->getEmail());
        if ($user && null === $user->getFacebookId()) {
            throw new EmailAlreadyUsedException();
        }

        return $user;
    }
}
