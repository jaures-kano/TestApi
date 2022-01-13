<?php

namespace App\Http\Api\Controller\Authentification\Registration;


use App\Application\Authentification\Registration\Command\FirstRegistrationCommand;
use App\Application\Authentification\Registration\Dto\RegistrationDto;
use App\Domain\EnabledCountry\Repository\EnabledCountryRepository;
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
                                          FirstRegistrationCommand $command,
                                          EnabledCountryRepository $repository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $country = $repository->find($data['country']);

        if ($country !== null) {
            $registrationDto = new RegistrationDto(
                $data['firstName'],
                $data['lastName'],
                $data['email'],
                $data['phone'],
                $country,
                $data['password'],
                $data['confirmPassword'],
                $data['confirmationMode']);
            $commandReponse = $command->saveFirstRegistration($registrationDto);
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
            'message' => 'Bad request, country not found'
        ], 400);
    }


}