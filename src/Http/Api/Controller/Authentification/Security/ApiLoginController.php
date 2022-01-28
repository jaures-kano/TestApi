<?php /** @noinspection PhpParamsInspection */

namespace App\Http\Api\Controller\Authentification\Security;

use App\Domain\AuthDomain\Auth\Entity\User;
use App\Infrastructures\JwtToken\JwtService;
use Exception;
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
            /** @var User $user */
            $jwt = $jwtService->createNewJWT($user);
            return $this->json([
                'message' => 'successfull login!',
                'user' => [
                    'id' => $user->getId(),
                    'google_id' => $user->getGoogleId(),
                    'facebook_id' => $user->getFacebookId(),
                    'email' => $user->getEmail(),
                    'lastName' => $user->getLastName(),
                    'firstName' => $user->getFirstName(),
                    'lastLoginAt' => $user->getLastLoginAt(),
                    'createdAt' => $user->getCreatedAt(),
                    'updatedAt' => $user->getUpdatedAt(),
                ],
                'token' => $jwt['token'],
                'refresh_token' => $jwt['refresh_refresh'],
                'expired_at' => $jwt['expired_at']
            ], 201, []);
        }

        return new JsonResponse([
            'message' => 'bad requests, verify your content-type or json format'
        ], 401);
    }

    /**
     * @Route("/logout", name="api_authentification_logout", methods={"GET"})
     * @throws Exception
     */
    public function logout()
    {
        return new JsonResponse([
            'message' => 'good by'
        ], 200);
    }
}