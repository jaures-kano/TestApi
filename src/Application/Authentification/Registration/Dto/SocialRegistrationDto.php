<?php

namespace App\Application\Authentification\Registration\Dto;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RegistrationDto
 * @package App\Application\AuthRegistration\Dto
 * @author jaures kano <ruddyjaures@mail.com>
 */
class SocialRegistrationDto
{
    public string $firstName;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    public string $email;

    public string $apiKey;

    public string $accountId;

    public function __construct(string $firstName,
                                string $email,
                                string $accountId,
                                string $apiKey
    )
    {
        $this->firstName = $firstName;
        $this->email = $email;
        $this->apiKey = $apiKey;
        $this->accountId = $accountId;
    }

}