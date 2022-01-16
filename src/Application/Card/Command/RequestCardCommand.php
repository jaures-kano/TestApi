<?php /** @noinspection PhpUnhandledExceptionInspection */


namespace App\Application\Card\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Card\Dto\CardRequestDto;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Domain\CardsDomain\Entity\Card;
use App\Domain\CardsDomain\Repository\CardTypeRepository;
use DateTime;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Card\Command
 */
class RequestCardCommand extends AbstractCase
{

    private UserRepository $userRepository;

    private CardTypeRepository $cardTypeRepository;

    private KeyService $keyService;

    public function __construct(UserRepository     $userRepository,
                                CardTypeRepository $cardTypeRepository,
                                KeyService         $keyService)
    {
        $this->userRepository = $userRepository;
        $this->cardTypeRepository = $cardTypeRepository;
        $this->keyService = $keyService;
    }

    public function requestCard(CardRequestDto $cardDto): CaseResponse
    {
        if ($this->keyService->isValidKey($cardDto->apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if (Ulid::isValid($cardDto->user) === false
            && Ulid::isValid($cardDto->cardType) === false) {
            return $this->errorResponse(
                [
                    'messsage' => CaseMessage::INVALID_ID
                ], HttpStatus::BADREQUEST);
        }

        $foundUser = $this->userRepository->findOneBy(['id' => $cardDto->user]);
        if ($foundUser === null) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::USER_NOT_EXIST
                ], HttpStatus::NOTFOUND);
        }


        $cardType = $this->cardTypeRepository->findOneBy(['id' => $cardDto->cardType]);
        if ($cardType === null) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::CARD_TYPE_NOT_EXIST
                ], HttpStatus::NOTFOUND);
        }

        $card = new Card();
        $card->setCardNumber('15251616516' . random_int(10, 100))
            ->setUser($foundUser)
            ->setCardType($cardType)
            ->setAmount($cardDto->amout)
            ->setCvv(random_int(100, 999))
            ->setExpiredAt(new DateTime('+1 year'))
            ->setCreatedAt(new DateTime());

        $this->em()->persist($card);
        $this->em()->flush();

        return $this->successResponse([
            'card_id' => $card->getId(),
            'card_cvv' => $card->getCvv(),
            'card_number' => $card->getCardNumber(),
            'card_amount' => $card->getAmount(),
            'card_validity' => $card->getExpiredAt(),
            'card_owner' => $card->getUser()->getFirstName() . ' ' . $card->getUser()->getLastName()
        ], HttpStatus::CREATED);
    }
}