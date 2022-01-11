<?php

namespace App\Application\Profile\Dto;


use App\Domain\AuthDomain\Auth\Entity\User;
use DateTimeInterface;

/**
 * Class ProfileDto
 * @package App\Application\ProfileDomain\Dto
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ProfileDto
{

    public User $user;

    public string $firstName;

    public string $lastName;

    public DateTimeInterface $birthDay;

    public string $password;

    /**
     * @param User $user
     * @param string $firstName
     * @param string $lastName
     * @param DateTimeInterface $birthDay
     * @param string $password
     */
    public function __construct(User              $user,
                                string            $firstName,
                                string            $lastName,
                                DateTimeInterface $birthDay,
                                string            $password)
    {
        $this->user = $user;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDay = $birthDay;
        $this->password = $password;
    }


}