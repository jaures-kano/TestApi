<?php

namespace App\Application\Profile\Dto;


/**
 * Class RequestPasswordDto
 * @package App\Application\Profile\Dto
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RequestPasswordDto
{
    public string $email;

    public string $confirmationCode;

    public string $password;

    public string $passwordConfirm;

    public string $apiKey;

    public function __construct(string $email,
                                string $confirmationCode,
                                string $password,
                                string $passwordConfirm,
                                string $apiKey)
    {
        $this->email = $email;
        $this->confirmationCode = $confirmationCode;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
        $this->apiKey = $apiKey;
    }

}