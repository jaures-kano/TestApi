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
use App\Domain\AuthDomain\AuthRegistration\Event\FirstRegistrationEvent;
use App\Infrastructures\Generator\ConfirmationAccountGenerator;
use DateTime;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class RegistrationCommand
 * @package App\Application\AuthRegistration\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationCommand extends AbstractCase
{

    private EventDispatcherInterface $eventDispatcher;
    private UserPasswordHasherInterface $hasher;
    private UserRepository $userRepository;
    private KeyService $keyService;


    public function __construct(EventDispatcherInterface    $eventDispatcher,
                                UserRepository              $userRepository,
                                KeyService                  $keyService,
                                UserPasswordHasherInterface $hasher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
        $this->keyService = $keyService;
    }

    public function registration(RegistrationDto $registrationDto, string $token = null): CaseResponse
    {
        if ($this->keyService->isValidKey($registrationDto->apiKey) === false) {
            return $this->errorResponse(CaseMessage::INVALIDKEY,
                [], HttpStatus::BADREQUEST);
        }


        $foundUser = $this->userRepository->findOneBy(['email' => $registrationDto->email]);

        if ($foundUser === null) {
            $user = new User();
            $generator = new ConfirmationAccountGenerator($user);
            $user->setEmail($registrationDto->email);
            $user->setPhone($registrationDto->email);
            $user->setConfirmationCode($generator->confirmCode());
//            $user->setEnabledCountry($registrationDto->country);
            $user->setCreatedAt(new DateTime());
            $user->setPassword($this->hasher->hashPassword($user, $registrationDto->password));
            $this->em()->persist($user);
            $this->em()->flush();

            $event = new FirstRegistrationEvent($user, $registrationDto->confirmationMode);
            $this->eventDispatcher->dispatch($event, FirstRegistrationEvent::NAME);

            return $this->successResponse('Code send to user', [], HttpStatus::CREATED);
        }

        return $this->errorResponse('Email already exist.', [], HttpStatus::NOTFOUND);
    }

}