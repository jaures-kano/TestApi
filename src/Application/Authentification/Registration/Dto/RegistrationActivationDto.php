<?php

namespace App\Application\Authentification\Registration\Dto;


/**
 * Class RegistrationActivationDto
 * @package App\Application\Authentification\Registration\Dto
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationActivationDto
{
    public string $email;

    public string $code;

    public string $apiKey;

    public function __construct(string $email, string $code, string $apiKey)
    {
        $this->email = $email;
        $this->code = $code;
        $this->apiKey = $apiKey;
    }
}