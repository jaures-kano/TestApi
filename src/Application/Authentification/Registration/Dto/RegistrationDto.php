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

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     * @param string $password
     * @param string $passwordConfirm
     * @param string $country
     * @param bool $confirmationMode
     */
    public function __construct(string $firstName,
                                string $lastName,
                                string $email,
                                string $phone,
                                string $password,
                                string $passwordConfirm,
                                string $country,
                                bool   $confirmationMode)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
        $this->country = $country;
        $this->confirmationMode = $confirmationMode;
    }


}