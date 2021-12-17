<?php

namespace App\Http\Api\Controller\Registration;


use App\Application\Registration\Command\FirstRegistrationCommand;
use App\Application\Registration\Dto\RegistrationDto;
use App\Domain\EnabledCountry\Repository\EnabledCountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegistrationsApiController
 * @package App\Http\Api\Controller\Registration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationsApiController extends AbstractController
{

    /**
     * @Route("/registration/first", name="registration_first")
     */
    public function indexFistRegistration(Request                  $request,
                                          FirstRegistrationCommand $command,
                                          EnabledCountryRepository $repository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $country = $repository->find($data['country']);

        if ($country !== null) {
            $registrationDto = new RegistrationDto(
                $data['email'],
                $data['phone'], $country,
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