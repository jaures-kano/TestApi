<?php

namespace App\Infrastructures\JwtToken;


use App\Domain\AuthDomain\Auth\Entity\User;
use DateTime;
use Exception;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWSProvider\JWSProviderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * Class JwtService
 * @package App\Infrastructures\Jwt
 * @author jaures kano <ruddyjaures@mail.com>
 */
class JwtService
{

    private JWTTokenManagerInterface $tokenManager;

    private RefreshTokenManagerInterface $refreshTokenManager;
    private JWSProviderInterface $jwsProvider;


    public function __construct(
        JWTTokenManagerInterface     $tokenManager,
        JWSProviderInterface         $jwsProvider,
        RefreshTokenManagerInterface $refreshTokenManager
    )
    {
        $this->tokenManager = $tokenManager;
        $this->refreshTokenManager = $refreshTokenManager;
        $this->jwsProvider = $jwsProvider;
    }

    public function createNewJWT(User $user): array
    {
        $token = $this->tokenManager->create($user);

        $datetime = new DateTime();
        $datetime->modify('+30 days');

        $lastToken = $this->refreshTokenManager->getLastFromUsername($user->getId());

        if ($lastToken === null) {
            $refreshToken = $this->refreshTokenManager->create();
            $refreshToken->setUsername($user->getId());
            $refreshToken->setRefreshToken();
            $refreshToken->setValid($datetime);
        } else {
            $lastToken->setValid($datetime);
            $refreshToken = $lastToken;
        }
        $this->refreshTokenManager->save($refreshToken);
        return [
            'token' => $token,
            'refresh_refresh' => $refreshToken->getRefreshToken(),
            'expired_at' => $datetime
        ];
    }

    public function isValidUserToken(string $token)
    {
        try {
            $jws = $this->jwsProvider->load($token);
        } catch (Exception $e) {
            return 'Invalid token';
        }

        if ($jws->isInvalid()) {
            return 'Invalid token';
        }

        if ($jws->isExpired()) {
            return 'Token expired';
        }

        if (!$jws->isVerified()) {
            return 'Token not verified';
        }

        return $jws->getPayload();
    }
}