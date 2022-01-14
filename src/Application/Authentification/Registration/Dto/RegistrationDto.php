<?php

namespace App\Application\Authentification\Registration\Dto;


/**
 * Class RegistrationDto
 * @package App\Application\AuthRegistration\Dto
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationDto
{
    public string $firstName;

    public string $lastName;

    public string $email;

    public string $phone;

    public string $password;

    public string $passwordConfirm;

    public string $country;

    public bool $confirmationMode;

    public string $apiKey;

    public function __construct(string $firstName,
                                string $lastName,
                                string $email,
                                string $phone,
                                string $password,
                                string $passwordConfirm,
                                bool   $confirmationMode,
                                string $country,
                                string $apiKey)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
        $this->country = $country;
        $this->confirmationMode = $confirmationMode;
        $this->apiKey = $apiKey;
    }


}