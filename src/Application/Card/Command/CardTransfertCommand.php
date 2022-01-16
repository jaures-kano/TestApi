<?php

namespace App\Application\Card\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Card\Dto\CardTransfertDto;
use App\Domain\CardsDomain\Repository\CardRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Ulid;

/**
 * Class CardTransfertCommand
 * @package App\Application\Card\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardTransfertCommand extends AbstractCase
{

    private CardRepository $cardRepository;
    private KeyService $keyService;
    private UserPasswordHasherInterface $hasher;

    public function __construct(CardRepository              $cardRepository,
                                UserPasswordHasherInterface $hasher,
                                KeyService                  $keyService)
    {
        $this->cardRepository = $cardRepository;
        $this->keyService = $keyService;
        $this->hasher = $hasher;
    }

    public function cardTransfert(CardTransfertDto $dto): CaseResponse
    {
        // dd($this->cardRepository->findAll());
        if ($this->keyService->isValidKey($dto->apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if (Ulid::isValid($dto->cardRecieverId) === false
            && Ulid::isValid($dto->cardSenderId) === false) {
            return $this->errorResponse(
                [
                    'messsage' => CaseMessage::INVALID_ID
                ], HttpStatus::BADREQUEST);
        }

        $cardSender = $this->cardRepository->findOneBy(['id' => $dto->cardSenderId]);
        if ($cardSender === null) {
            return $this->errorResponse(
                [
                    'message' => 'Sender user not found'
                ], HttpStatus::NOTFOUND);
        }

        $cardReciever = $this->cardRepository->findOneBy(['id' => $dto->cardRecieverId]);
        if ($cardReciever === null) {
            return $this->errorResponse(
                [
                    'message' => 'Reciever user not found'
                ], HttpStatus::NOTFOUND);
        }

        $user = $cardSender->getUser();
        if ($this->hasher->isPasswordValid($user, $dto->cardUserPassword) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::WRONG_PASSWORD
                ], HttpStatus::FORBIDEN);
        }

        if ($cardSender->getAmount() < $dto->amount) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INSUFFICIENT
                ], HttpStatus::BADREQUEST);
        }

        $cardSender->setAmount($cardSender->getAmount() - $dto->amount);
        $this->em()->persist($cardSender);

        $cardReciever->setAmount($cardReciever->getAmount() + $dto->amount);
        $this->em()->persist($cardReciever);
        $this->em()->flush();

        return $this->successResponse([
            'message' => 'Transfert initiated'
        ], HttpStatus::ACCEPTED);
    }
}