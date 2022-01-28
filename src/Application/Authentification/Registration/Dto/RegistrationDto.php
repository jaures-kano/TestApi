<?php

namespace App\Application\Authentification\Registration\Dto;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RegistrationDto
 * @package App\Application\AuthRegistration\Dto
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationDto
{
    /**
     * @Assert\NotBlank
     */
    public string $firstName;

    /**
     * @Assert\NotBlank
     */
    public string $lastName;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    public string $email;

    /**
     * @Assert\NotBlank
     */
    public string $phone;

    public ?string $password;


    public ?string $passwordConfirm;

    /**
     * @Assert\NotBlank
     */
    public string $apiKey;

    public function __construct(string  $firstName,
                                string  $lastName,
                                string  $email,
                                string  $apiKey,
                                ?string $password = null,
                                ?string $passwordConfirm = null
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
        $this->apiKey = $apiKey;
    }


}