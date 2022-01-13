<?php

namespace App\Http\Api\Controller\Authentification\Security;


use App\Application\Profile\Command\AccountRecoverCommand;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/authentification")
 * Class ApiRecoverAccountController
 * @package App\Http\Api\Controller\Security
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiRecoverAccountController extends AbstractController
{
    /**
     * @Route("/account/recover", name="api_recover_account")
     */
    public function indexRecoverPassword(Request               $request,
                                         UserRepository        $userRepository,
                                         AccountRecoverCommand $command): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $email = $content['email'];
        $phone = $content['phone'];
        $isMail = $content['isMail'];

        $user = $userRepository->findUserBy($email, $phone);
        if ($user !== null) {
            $commandResponse = $command->recoverPassword($user, $isMail);
            if ($commandResponse->type) {
                return $this->json([
                    'message' => $commandResponse->messages
                ]);
            }
            return $this->json([
                'message' => $commandResponse->messages
            ], 400);
        }

        return $this->json([
            'message' => 'User not found'
        ], 404);
    }

}