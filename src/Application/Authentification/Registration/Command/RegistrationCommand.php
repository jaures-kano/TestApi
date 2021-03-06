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
use App\Infrastructures\Generator\TokenGenerator;
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
    private TokenGenerator $tokenGenerator;

    public function __construct(EventDispatcherInterface    $eventDispatcher,
                                UserRepository              $userRepository,
                                KeyService                  $keyService,
                                TokenGenerator              $tokenGenerator,
                                UserPasswordHasherInterface $hasher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
        $this->keyService = $keyService;
        $this->tokenGenerator = $tokenGenerator;
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

        if ($registrationDto->password !== $registrationDto->passwordConfirm) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::CODE_ERROR
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
        $user->setConfirmationToken($this->tokenGenerator->getAuthToken());
        $user->setCreatedAt(new DateTime());
        $user->setPassword($this->hasher->hashPassword($user, $registrationDto->password));
        $this->em()->persist($user);
        $this->em()->flush();

        //dispatch event
        $event = new FirstRegistrationEvent($user, true);
        $this->eventDispatcher->dispatch($event, FirstRegistrationEvent::NAME);

        return $this->successResponse(
            [
                'message' => 'Code send to user, token expired after 30 minutes'
            ], HttpStatus::CREATED);
    }

}