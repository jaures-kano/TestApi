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
            'firstName', 'lastName', 'email', 'phone',
            'country', 'password', 'confirmPassword', 'confirmationMode'
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
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['phone'],
            $data['country'],
            $data['password'],
            $data['confirmPassword'],
            $data['confirmationMode']);

        // send action to application
        $commandReponse = $command->registration($registrationDto);
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