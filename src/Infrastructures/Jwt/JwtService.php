<?php

namespace App\Infrastructures\Jwt;


use App\Domain\Auth\Entity\User;
use DateTime;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
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

    public function __construct(
        JWTTokenManagerInterface     $tokenManager,
        RefreshTokenManagerInterface $refreshTokenManager
    )
    {
        $this->tokenManager = $tokenManager;
        $this->refreshTokenManager = $refreshTokenManager;
    }

    public function createNewJWT(User $user): array
    {
        $token = $this->tokenManager->create($user);

        $datetime = new DateTime();
        $datetime->modify('+3600 seconds');

        $refreshToken = $this->refreshTokenManager->create();
        $refreshToken->setUsername($user->getUserIdentifier());
        $refreshToken->setRefreshToken();
        $refreshToken->setValid($datetime);

        $this->refreshTokenManager->save($refreshToken);

        return [
            'token' => $token,
            'refresh_refresh' => $refreshToken->getRefreshToken(),
            'expired_at' => $datetime
        ];
    }

}