<?php

namespace App\Http\Api\Controller\Authentification\Registration;


use App\Application\Authentification\Registration\Command\RegistrationActivationCommand;
use App\Application\Authentification\Registration\Dto\RegistrationActivationDto;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/authentification")
 * Class RegistrationActivationController
 * @package App\Http\Api\Controller\Authentification\Registration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationActivationController extends AbstractController
{

    /**
     * @Route("/registration/activation", name="api_auth_registration_activation", methods={"post"})
     */
    public function indexRegistrationActivate(Request                       $request,
                                              RegistrationActivationCommand $command,
                                              ParamatersCheckerService      $checkerService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            return $this->json(['message' => 'Bad request, invalid json'], Response::HTTP_BAD_REQUEST);
        }

        /// verify if data require
        $requireData = ['email', 'code', 'api_key'];
        $missingParameter = $checkerService->arrayCheck($data, $requireData);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter ' . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $dto = new RegistrationActivationDto(
            $data['email'],
            $data['code'],
            $data['api_key']
        );
        $commandReponse = $command->activateAccount($dto);

        return $this->json($commandReponse->data, $commandReponse->status);
    }

}