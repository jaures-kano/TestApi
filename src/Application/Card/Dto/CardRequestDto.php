<?php


namespace App\Application\Card\Dto;



/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Card\Dto
 */
class CardRequestDto
{

    public string $user;
    public string $cardType;
    public string $amout;
    public string $paiementType;
    public string $apiKey;
    public string $access_token;

    public function __construct(string $user,
                                string $cardType,
                                string $amout,
                                string $paiementType,
                                string $apiKey,
                                string $access_token)
    {
        $this->user = $user;
        $this->cardType = $cardType;
        $this->amout = $amout;
        $this->paiementType = $paiementType;
        $this->apiKey = $apiKey;
        $this->access_token = $access_token;
    }
}