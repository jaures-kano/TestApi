<?php

namespace App\Http\Api\Controller\Profile;


use App\Application\Profile\Command\ResetPasswordCommand;
use App\Application\Profile\Dto\ResetPasswordDto;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/profile")
 * Class ApiResetAccountController
 * @package App\Http\Api\Controller\Authentification\Security
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiResetAccountController extends AbstractController
{
    /**
     * @Route("/account/reset", name="api_reset_account")
     */
    public function indexResetPassword(Request                  $request,
                                       ParamatersCheckerService $checkerService,
                                       ResetPasswordCommand     $command): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        if ($content === null) {
            return $this->json(['message' => 'Bad request, invalid json'],
                Response::HTTP_BAD_REQUEST);
        }

        /// verify if data require
        $missingParameter = $checkerService->arrayCheck($content,
            ['email', 'confirmation_code', 'password', 'password_confirm', 'api_key']);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter'
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $dto = new ResetPasswordDto(
            $content['email'],
            $content['confirmation_code'],
            $content['password'],
            $content['password_confirm'],
            $content['api_key']
        );

        $commandReponse = $command->resetPassword($dto);

        return $this->json($commandReponse->data, $commandReponse->status);
    }

}