<?php

namespace App\Application\QrCode\Query;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Domain\QrCodeDomain\Repository\QrCodeAffiliationRepository;
use App\Domain\QrCodeDomain\Repository\QrCodeTransactionRepository;

/**
 * Class CheckQrCodeQuery
 * @package App\Application\QrCode\Query
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CheckQrCodeQuery extends AbstractCase
{


    private QrCodeAffiliationRepository $affiliationRepository;
    private KeyService $keyService;
    private QrCodeTransactionRepository $transactionRepository;

    public function __construct(QrCodeAffiliationRepository $affiliationRepository,
                                KeyService                  $keyService,
                                QrCodeTransactionRepository $transactionRepository)
    {
        $this->affiliationRepository = $affiliationRepository;
        $this->keyService = $keyService;
        $this->transactionRepository = $transactionRepository;
    }

    public function check(string $code, string $apiKey): CaseResponse
    {
        if ($this->keyService->isValidKey($apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        $ifAffiliationCode = $this->affiliationRepository->findOneBy(['qrCode' => $code]);
        if ($ifAffiliationCode !== null) {
            return $this->successResponse([
                'type' => 'transaction',
                'entreprise' => [
                    'id' => $ifAffiliationCode->getEntreprise()->getId(),
                    'enteprise' => $ifAffiliationCode->getEntreprise()->getDescription(),
                    'description' => $ifAffiliationCode->getEntreprise()->getDescription(),
                ],
                'link' => '/entreprise/affiliation'
            ], HttpStatus::ACCEPTED);
        }

        $ifTransactonCode = $this->transactionRepository->findOneBy(['qrCode' => $code]);
        if ($ifTransactonCode !== null) {
            $user = $ifTransactonCode->getUser();
            return $this->successResponse([
                'type' => 001,
                'desc' => 'Qr code for transaction',
                'owner' => [
                    'firstName' => $user->getFirstName(),
                    'lastName' => $user->getLastName(),
                    'isCertified' => $user->getIdentityVerified(),
                    'email' => $user->getEmail(),
                    'phone' => $user->getEnabledCountry()->getCallingCode() . $user->getPhone(),
                    'country' => $user->getEnabledCountry()->getName()
                ],
                'entreprise' => $ifTransactonCode->getEntreprise() !== null ? [
                    'enteprise' => $ifTransactonCode->getEntreprise()->getDescription(),
                    'description' => $ifTransactonCode->getEntreprise()->getDescription(),
                ] : null,
                'cardId' => $ifTransactonCode->getCard()->getId(),
                'link' => '/api/card/transfert'
            ], HttpStatus::ACCEPTED);
        }

        return $this->errorResponse([
            'message' => 'Qr code unknow'
        ], HttpStatus::NOTFOUND);

    }

}