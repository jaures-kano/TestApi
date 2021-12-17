<?php

namespace App\Application\Registration\Dto;


use App\Domain\EnabledCountry\Entity\EnabledCountry;

/**
 * Class RegistrationDto
 * @package App\Application\Registration\Dto
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationDto
{
    public string $email;

    public string $phone;

    public EnabledCountry $country;

    public bool $confirmationMode;

    /**
     * @param string $email
     * @param string $phone
     * @param EnabledCountry $country
     * @param bool $confirmationMode
     */
    public function __construct(string         $email,
                                string         $phone,
                                EnabledCountry $country,
                                bool           $confirmationMode)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->country = $country;
        $this->confirmationMode = $confirmationMode;
    }


}