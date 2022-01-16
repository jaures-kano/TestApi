<?php

namespace App\Http\Api\Controller\Cards;


use App\Application\Card\Command\CardTransfertCommand;
use App\Application\Card\Dto\CardTransfertDto;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/card")
 * Class ApiCardTransfertController
 * @package App\Http\Api\Controller\Cards
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiCardTransfertController extends AbstractController
{

    /**
     * @Route("/transfert", name="api_card_new_transfert")
     */
    public function cardTransfertRequest(Request                  $request,
                                         ParamatersCheckerService $checkerService,
                                         CardTransfertCommand     $transfertCommand): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            return $this->json(['message' => 'Bad request, invalid json'], Response::HTTP_BAD_REQUEST);
        }

        /// verify if data require
        $requireData = ['card_sender_id', 'card_receiver_id', 'api_key',
            'access_token', 'amount', 'card_user_password'];
        $missingParameter = $checkerService->arrayCheck($data, $requireData);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter ' . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $newDto = new CardTransfertDto(
            (float)$data['amount'],
            $data['card_sender_id'],
            $data['card_receiver_id'],
            $data['card_user_password'],
            $data['api_key'],
            $data['access_token']
        );

        $commandReponse = $transfertCommand->cardTransfert($newDto);
        return $this->json($commandReponse->data, $commandReponse->status);
    }

}