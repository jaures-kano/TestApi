<?php

namespace App\Http\Api\Controller\Security;

use DateInterval;
use DateTime;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiLoginController extends AbstractController
{

    /**
     * @Route("/api/auth/login", name="api_route_login")
     */
    public function indexApiLogin(JWTTokenManagerInterface     $jwt,
                                  RefreshTokenManagerInterface $refreshTokenManager): JsonResponse
    {
        $user = $this->getUser();
        if ($user !== null) {
            $token = $jwt->create($user);
            $valid = new DateTime('now');
            $valid->add(new DateInterval('P3D'));

            $refreshToken = $refreshTokenManager->create();
            $refreshToken->setUsername($user->getUserIdentifier());
            $refreshToken->setRefreshToken();
            $refreshToken->setValid($valid);

            return $this->json([
                'message' => 'successfull login!',
                'user' => $user,
                'token' => $token,
                'refresh_token' => $refreshTokenManager->save($refreshToken)
            ], 201, [], ['groups' => 'read:user']);
        }

        return new JsonResponse([
            'message' => 'bad requests, verify your content-type or json format'
        ], 401);
    }
}