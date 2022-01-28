<?php

namespace App\Application\Authentification\Registration\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Authentification\Registration\Dto\RegistrationDto;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use DateTime;

/**
 * Class RegistrationCommand
 * @package App\Application\AuthRegistration\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class SocialRegistrationCommand extends AbstractCase
{
    private UserRepository $userRepository;
    private KeyService $keyService;

    public function __construct(UserRepository $userRepository,
                                KeyService     $keyService)
    {
        $this->userRepository = $userRepository;
        $this->keyService = $keyService;
    }

    public function registration(RegistrationDto $registrationDto): CaseResponse
    {
        if ($this->keyService->isValidKey($registrationDto->apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if (!filter_var($registrationDto->email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::MAIL_INVALID
                ], HttpStatus::BADREQUEST);
        }

        $foundUser = $this->userRepository->findOneBy(['email' => $registrationDto->email]);
        if ($foundUser !== null) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::MAIL_USED
                ], HttpStatus::BADREQUEST);
        }

        $user = new User();
        $user->setEmail($registrationDto->email);
        $user->setFirstName($registrationDto->firstName);
        $user->setLastName($registrationDto->lastName);
        $user->setCreatedAt(new DateTime());
        $this->em()->persist($user);
        $this->em()->flush();

        return $this->successResponse(
            [
                'message' => 'Code send to user, token expired after 30 minutes'
            ], HttpStatus::CREATED);
    }

}