<?php

namespace App\Http\Api\Controller\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiLoginController extends AbstractController
{

    /**
     * @Route("/api/login", name="api_route_login")
     */
    public function indexApiLogin(JWTTokenManagerInterface $jwt): JsonResponse
    {
        $user = $this->getUser();
        if ($user !== null) {
            return $this->json([
                'message' => 'successfull login!',
                'user' => $user,
                'token' => $jwt->create($user),
            ], 201, [], ['groups' => 'read:user']);
        }

        return new JsonResponse([
            'message' => 'bad requests, verify your content-type or json format'
        ], 401);
    }
}