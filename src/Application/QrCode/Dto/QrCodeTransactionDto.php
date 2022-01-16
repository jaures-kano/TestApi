<?php


namespace App\Application\QrCode\Dto;

/**
 * Class QrCodeTransactionDto
 * @package App\Application\QrCodeDomain\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class QrCodeTransactionDto
{
    public string $designation;

    public string $card;

    public string $user;

    public string $apiKey;

    public ?string $entreprise;

    public ?string $qrCode;

    public function __construct(string  $designation,
                                string  $user,
                                string  $card,
                                string  $apiKey,
                                ?string $entreprise,
                                ?string $qrCode)
    {
        $this->designation = $designation;
        $this->user = $user;
        $this->card = $card;
        $this->entreprise = $entreprise;
        $this->qrCode = $qrCode;
        $this->apiKey = $apiKey;
    }
}