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

    public string $apiKey;

    public ?string $entreprise;

    public function __construct(string  $designation,
                                string  $card,
                                string  $apiKey,
                                ?string $entreprise)
    {
        $this->designation = $designation;
        $this->card = $card;
        $this->entreprise = $entreprise;
        $this->apiKey = $apiKey;
    }
}