<?php


namespace App\Application\QrCode\Dto;

/**
 * Class QrCodeTransactionDto
 * @package App\Application\QrCodeDomain\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class QrCodeAffiliationDto
{
    public string $designation;

    public string $apiKey;

    public ?string $entreprise;

    public ?string $qrCode;

    public function __construct(string  $designation,
                                string  $apiKey,
                                ?string $entreprise,
                                ?string $qrCode)
    {
        $this->designation = $designation;
        $this->entreprise = $entreprise;
        $this->qrCode = $qrCode;
        $this->apiKey = $apiKey;
    }
}