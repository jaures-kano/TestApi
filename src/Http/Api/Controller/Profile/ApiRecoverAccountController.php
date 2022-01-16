<?php

namespace App\Http\Api\Controller\Profile;


use App\Application\Profile\Command\RequestRecoverCommand;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/profile")
 * Class ApiRecoverAccountController
 * @package App\Http\Api\Controller\Security
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiRecoverAccountController extends AbstractController
{
    /**
     * @Route("/account/recover", name="api_recover_account")
     */
    public function indexRecoverPassword(Request                  $request,
                                         ParamatersCheckerService $checkerService,
                                         RequestRecoverCommand    $command): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        if ($content === null) {
            return $this->json(['message' => 'Bad request, invalid json'],
                Response::HTTP_BAD_REQUEST);
        }

        /// verify if data require
        $missingParameter = $checkerService->arrayCheck($content,
            ['email', 'confirmation_mode', 'api_key']);

        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter'
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $commandResponse = $command->recoverPassword
        ($content['email'], $content['confirmation_mode'], $content['api_key']);
        return $this->json($commandResponse->data, $commandResponse->status);
    }

}