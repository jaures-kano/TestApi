<?php

namespace App\Http\Api\Controller\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
            $token = $jwt->create($user);
            return $this->json([
                'message' => 'successfull login!',
                'user' => $user,
                'token' => $token,
            ], 201, [], ['groups' => 'read:user']);
        }

        return new JsonResponse([
            'message' => 'Invalide credential'
        ], 401);
    }


    /**
     * @Route("/api/test", name="api_route_login")
     */
    public function index(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        dd($data, $request->getContent());
        return $this->json($data);
    }
}