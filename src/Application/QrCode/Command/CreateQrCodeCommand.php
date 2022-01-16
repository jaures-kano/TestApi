<?php


namespace App\Application\QrCode\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\QrCode\Dto\QrCodeTransactionDto;
use App\Application\QrCode\QrCodeService;
use App\Domain\CardsDomain\Repository\CardRepository;
use App\Domain\EntrepriseDomain\Entreprise\Repository\EntrepriseRepository;
use App\Domain\QrCodeDomain\Entity\QrCodeTransaction;
use DateTime;
use Symfony\Component\Uid\Ulid;

class CreateQrCodeCommand extends AbstractCase
{


    private CardRepository $cardRepository;
    private KeyService $keyService;
    private EntrepriseRepository $entrepriseRepository;

    public function __construct(CardRepository       $cardRepository,
                                KeyService           $keyService,
                                EntrepriseRepository $entrepriseRepository)
    {

        $this->cardRepository = $cardRepository;
        $this->keyService = $keyService;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function createTransactionQrCode(QrCodeTransactionDto $qrCodeDto): caseResponse
    {
        $qrCode = new QrCodeTransaction();
        $service = new QrCodeService();
        if ($this->keyService->isValidKey($qrCodeDto->apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if (Ulid::isValid($qrCodeDto->card) === false) {
            return $this->errorResponse(
                [
                    'messsage' => CaseMessage::INVALID_ID
                ], HttpStatus::BADREQUEST);
        }

        $card = $this->cardRepository->findOneBy(['id' => $qrCodeDto->card]);
        if ($card === null) {
            return $this->errorResponse(
                [
                    'message' => 'Sender user not found'
                ], HttpStatus::NOTFOUND);
        }

        $qrCode->setQrCode($service->generateTransactionQrCode($card))
            ->setDesignation($qrCodeDto->designation)
            ->setCard($card)
            ->setIsEnabled(true)
            ->setCreatedAt(new DateTime())
            ->setUser($card->getUser());

        if ($qrCodeDto->entreprise !== null) {
            if (Ulid::isValid($qrCodeDto->entreprise) === false) {
                return $this->errorResponse(
                    [
                        'messsage' => CaseMessage::INVALID_ID
                    ], HttpStatus::BADREQUEST);
            }
            $entreprise = $this->entrepriseRepository->findOneBy(['id' => $qrCodeDto->entreprise]);
            $qrCode->setEntreprise($entreprise);
        }

        $this->em()->persist($qrCode);
        $this->em()->flush();

        return $this->successResponse([
            'qrCode' => $qrCode->getQrCode(),
            'designation' => $qrCode->getDesignation(),
            'message' => 'New qr code created',
        ], HttpStatus::CREATED);
    }
}