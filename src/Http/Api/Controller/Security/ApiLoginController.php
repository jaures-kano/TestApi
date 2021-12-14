<?php

namespace App\Http\Api\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class ApiLoginController extends AbstractController
{

    /**
     * @Route("/api/login", name="api_route_login")
     */
    public function indexApiLogin(AuthenticationException $exception): JsonResponse
    {
        $user = $this->getUser();
        if ($user !== null) {
            return new JsonResponse([
                'message' => $exception->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'message' => 'bad request'
        ], 401);
    }
}