<?php

namespace App\Http\Api\Controller\Authentification\Registration;


use App\Application\Authentification\Registration\Command\RegistrationCommand;
use App\Application\Authentification\Registration\Dto\RegistrationDto;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
        $requireData = [
            'first_name', 'last_name', 'email', 'phone', 'api_key', 'access_token',
            'country', 'password', 'confirm_password', 'confirmation_mode'
        ];

        /// verify if data require
        $missingParameter = $checkerService->arrayCheck($data, $requireData);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, parameter '
                    . implode(", ", $missingParameter['missing']) .
                    ' are missing'
            ], 406);
        }

        // chargement du dto
        $registrationDto = new RegistrationDto(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['password'],
            $data['confirmPassword'],
            $data['confirmationMode'],
            $data['country'],
            $data['api_key']);

        // send action to application
        $commandReponse = $command->registration($registrationDto, $data['access_token']);
        if ($commandReponse->type === true) {
            return $this->json([
                'message' => $commandReponse->messages
            ], $commandReponse->status);
        }


        return $this->json([
            'message' => $commandReponse->messages
        ], $commandReponse->status);
    }

}