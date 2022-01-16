<?php

namespace App\Application\Card\Query;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Domain\CardsDomain\Repository\CardRepository;
use App\Infrastructures\JwtToken\JwtService;

/**
 * Class CardQuery
 * @package App\Application\Card\Query
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardQuery extends AbstractCase
{

    private KeyService $keyService;
    private JwtService $jwtService;
    private CardRepository $cardRepository;
    private UserRepository $userRepository;

    public function __construct(KeyService     $keyService,
                                CardRepository $cardRepository,
                                UserRepository $userRepository,
                                JwtService     $jwtService)
    {
        $this->keyService = $keyService;
        $this->jwtService = $jwtService;
        $this->cardRepository = $cardRepository;
        $this->userRepository = $userRepository;
    }

    public function getUserCard(string $accessToken, string $apiKey): CaseResponse
    {
        if ($this->keyService->isValidKey($apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        $tokenResponse = $this->jwtService->isValidUserToken($accessToken);
        if (is_array($tokenResponse) === false) {
            return $this->errorResponse([
                'message' => $tokenResponse
            ], HttpStatus::BADREQUEST);
        }

        $user = $this->userRepository->findOneBy(['email' => $tokenResponse['username']]);
        if ($user === null) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::USER_NOT_EXIST
                ], HttpStatus::FORBIDEN);
        }

        $cardsQuery = $this->cardRepository->findBy(['user' => $user]);
        $cards = [];

        foreach ($cardsQuery as $card) {
            $cards[] = [
                'cardNumber' => $card->getCardNumber(),
                'cardId' => $card->getId(),
                'cardCvv' => $card->getCvv(),
                'cardOwner' => $card->getUser()->getFirstName() . ' ' . $card->getUser()->getLastName(),
                'expiredAt' => $card->getId(),
                'amount' => $card->getAmount()
            ];
        }

        return $this->successResponse([
            'cards' => $cards,
            'totlCard' => count($cardsQuery)
        ], HttpStatus::ACCEPTED);
    }
}