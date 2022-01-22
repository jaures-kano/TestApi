<?php

namespace App\Application\Card\Query;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Infrastructures\JwtToken\JwtService;

/**
 * Class CardCheckQuery
 * @package App\Application\Card\Query
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardCheckQuery extends AbstractCase
{

    private KeyService $keyService;
    private UserRepository $userRepository;
    private JwtService $jwtService;

    public function __construct(KeyService     $keyService,
                                UserRepository $userRepository,
                                JwtService     $jwtService)
    {
        $this->keyService = $keyService;
        $this->userRepository = $userRepository;
        $this->jwtService = $jwtService;
    }

    public function checkCard(string $accessToken, string $apiKey, string $email): CaseResponse
    {
        if ($this->keyService->isValidKey($apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

//        $tokenResponse = $this->jwtService->isValidUserToken($accessToken);
//        if (is_array($tokenResponse) === false) {
//            return $this->errorResponse([
//                'message' => $tokenResponse
//            ], HttpStatus::BADREQUEST);
//        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::MAIL_INVALID
                ], HttpStatus::BADREQUEST);
        }

        $user = $this->userRepository->findOneBy(['email' => $email]);
        if ($user === null) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::USER_NOT_EXIST
                ], HttpStatus::FORBIDEN);
        }

        if ($user->getCards()->count() > 0) {
            $card = $user->getCards()->first();
            return $this->successResponse([
                'totalCard' => $user->getCards()->count(),
                'card' => [
                    'cardNumber' => $card->getCardNumber(),
                    'cardId' => $card->getId(),
                    'cardCvv' => $card->getCvv(),
                    'cardOwner' => $card->getUser()->getFirstName() . ' ' . $card->getUser()->getLastName(),
                    'expiredAt' => $card->getId(),
                    'amount' => $card->getAmount()
                ]
            ], HttpStatus::ACCEPTED);
        }

        return $this->successResponse([
            'totalCard' => 0,
            'message' => 'User d\'ont have any card'
        ], HttpStatus::ACCEPTED);
    }
}