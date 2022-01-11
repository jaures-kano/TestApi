<?php

namespace App\Application\Profile\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\Response\CaseResponse;
use App\Application\Profile\Dto\ProfileDto;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UpdateProfileCommand
 * @package App\Application\ProfileDomain\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class UpdateProfileCommand extends AbstractCase
{

    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function updatedProfile(ProfileDto $dto): CaseResponse
    {
        $userSend = $dto->user;
        $userSend->setFirstName($dto->firstName);
        $userSend->setLastName($dto->lastName);
        $userSend->setBirhday($dto->birthDay);
        $userSend->setPassword($this->hasher->hashPassword($userSend, $dto->password));
        $this->em()->persist($userSend);
        $this->em()->flush();

        return $this->successResponse('User profile is update it can connect with his password', []);
    }

}