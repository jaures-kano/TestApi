<?php


namespace App\Application\Card\Dto;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Card\CardTransfertDto
 */
class CardTransfertDto
{
    public float $amount;
    public string $cardSenderId;
    public string $cardRecieverId;
    public string $cardUserPassword;
    public string $apiKey;
    public string $access_token;

    public function __construct(float  $amount,
                                string $cardSenderId,
                                string $cardRecieverId,
                                string $cardUserPassword,
                                string $apiKey,
                                string $access_token)
    {
        $this->amount = $amount;
        $this->cardSenderId = $cardSenderId;
        $this->cardRecieverId = $cardRecieverId;
        $this->cardUserPassword = $cardUserPassword;
        $this->apiKey = $apiKey;
        $this->access_token = $access_token;
    }
}