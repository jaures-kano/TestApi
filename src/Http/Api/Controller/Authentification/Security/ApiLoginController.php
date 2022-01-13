<?php /** @noinspection PhpParamsInspection */

namespace App\Http\Api\Controller\Authentification\Security;

use App\Infrastructures\JwtToken\JwtService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("api/authentification")
 */
class ApiLoginController extends AbstractController
{

    /**
     * @Route("/login", name="api_authentification_login")
     */
    public function indexApiLogin(JwtService $jwtService): JsonResponse
    {
        $user = $this->getUser();
        if ($user !== null) {
            $jwt = $jwtService->createNewJWT($user);
            return $this->json([
                'message' => 'successfull login!',
                'user' => $user,
                'token' => $jwt['token'],
                'refresh_token' => $jwt['refresh_refresh'],
                'expired_at' => $jwt['expired_at']
            ], 201, [], ['groups' => 'read:user']);
        }

        return new JsonResponse([
            'message' => 'bad requests, verify your content-type or json format'
        ], 401);
    }
}