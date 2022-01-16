<?php

namespace App\Http\Api\Controller\Cards;


use App\Application\Card\Command\RequestCardCommand;
use App\Application\Card\Dto\CardRequestDto;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/card")
 * Class ApiCardController
 * @package App\Http\Api\Controller\Cards
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiCardController extends AbstractController
{

    /**
     * @Route("/request", name="api_card_new_request")
     */
    public function newCardRequest(Request                  $request,
                                   ParamatersCheckerService $checkerService,
                                   RequestCardCommand       $requestCardCommand): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            return $this->json(['message' => 'Bad request, invalid json'], Response::HTTP_BAD_REQUEST);
        }

        /// verify if data require
        $requireData = ['user_id', 'card_type', 'api_key', 'access_token', 'paiement_method', 'amount'];
        $missingParameter = $checkerService->arrayCheck($data, $requireData);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter ' . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $newDto = new CardRequestDto(
            $data['user_id'],
            $data['card_type'],
            $data['amount'],
            $data['paiement_method'],
            $data['api_key'],
            $data['access_token']
        );

        $commandReponse = $requestCardCommand->requestCard($newDto);
        return $this->json($commandReponse->data, $commandReponse->status);
    }
}