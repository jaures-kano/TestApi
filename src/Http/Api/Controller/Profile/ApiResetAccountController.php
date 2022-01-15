<?php

namespace App\Http\Api\Controller\Profile;


use App\Application\Profile\Command\RequestRecoverCommand;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/profle")
 * Class ApiResetAccountController
 * @package App\Http\Api\Controller\Authentification\Security
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiResetAccountController extends AbstractController
{
    /**
     * @Route("/account/reset", name="api_reset_account")
     */
    public function indexResetPassword(Request               $request,
                                       UserRepository        $userRepository,
                                       RequestRecoverCommand $command): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $password = $content['password'];
        $passwordConfirm = $content['passwordConfirm'];
        $resetCode = $content['resetCode'];

        $user = $userRepository->findOneBy(['resetCode' => $resetCode]);
        if ($user !== null && $password === $passwordConfirm) {
            $commandReponse = $command->resetPassword($user, $resetCode, $password);
            if ($commandReponse->type === true) {
                return $this->json([
                    'message' => $commandReponse->messages
                ]);
            }
            return $this->json([
                'message' => $commandReponse->messages
            ], 400);
        }

        return $this->json([
            'message' => 'Invalide reset code or password don\'t match'
        ], 400);
    }

}