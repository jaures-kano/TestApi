<?php

namespace App\Http\Api\Controller\Authentification\Registration;


use App\Application\Authentification\Registration\Command\RegistrationCommand;
use App\Application\Authentification\Registration\Dto\RegistrationDto;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/authentification")
 * Class RegistrationsApiController
 * @package App\Http\Api\Controller\AuthRegistration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationsApiController extends AbstractController
{

    /**
     * @Route("/registration", name="api_auth_registration")
     */
    public function indexFistRegistration(Request                  $request,
                                          ParamatersCheckerService $checkerService,
                                          RegistrationCommand      $command): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            return $this->json(['message' => 'Bad request, invalid json'], Response::HTTP_BAD_REQUEST);
        }

        $requireData = [
            'first_name', 'last_name', 'email', 'api_key', 'password', 'confirm_password',
        ];

        /// verify if data require
        $missingParameter = $checkerService->arrayCheck($data, $requireData);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter '
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        // chargement du dto
        $registrationDto = new RegistrationDto(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['api_key'],
            $data['password'],
            $data['confirm_password']);

        // send action to application
        $commandReponse = $command->registration($registrationDto);
        return $this->json($commandReponse->data, $commandReponse->status);
    }

}