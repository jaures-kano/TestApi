<?php

namespace App\Http\App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
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
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
