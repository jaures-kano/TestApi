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
use App\Domain\EnabledCountry\Repository\EnabledCountryRepository;
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
    private EnabledCountryRepository $enabledCountryRepository;

    public function __construct(EventDispatcherInterface    $eventDispatcher,
                                UserRepository              $userRepository,
                                EnabledCountryRepository    $enabledCountryRepository,
                                KeyService                  $keyService,
                                UserPasswordHasherInterface $hasher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
        $this->keyService = $keyService;
        $this->enabledCountryRepository = $enabledCountryRepository;
    }

    public function registration(RegistrationDto $registrationDto): CaseResponse
    {
        if ($this->keyService->isValidKey($registrationDto->apiKey) === false) {
            return $this->errorResponse(CaseMessage::INVALID_KEY,
                [], HttpStatus::BADREQUEST);
        }

        if (!filter_var($registrationDto->email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(CaseMessage::MAIL_INVALID,
                [], HttpStatus::BADREQUEST);
        }

        if ($registrationDto->password !== $registrationDto->passwordConfirm) {
            return $this->errorResponse('Password is not matching',
                [], HttpStatus::BADREQUEST);
        }

        $country = $this->enabledCountryRepository
            ->findOneBy(['id' => $registrationDto->country, 'isEnabled' => true]);

        if ($country === null) {
            return $this->errorResponse(CaseMessage::UNKNOW_COUNTRY,
                [], HttpStatus::BADREQUEST);
        }

        $foundUser = $this->userRepository->findOneBy(['email' => $registrationDto->email]);

        if ($foundUser !== null) {
            return $this->errorResponse(CaseMessage::MAIL_USED,
                [], HttpStatus::BADREQUEST);
        }

        $user = new User();
        $generator = new ConfirmationAccountGenerator($user);
        $user->setEmail($registrationDto->email);
        $user->setPhone($registrationDto->phone);
        $user->setFirstName($registrationDto->firstName);
        $user->setLastName($registrationDto->lastName);
        $user->setConfirmationCode($generator->confirmCode());
        $user->setEnabledCountry($country);
        $user->setCreatedAt(new DateTime());
        $user->setPassword($this->hasher->hashPassword($user, $registrationDto->password));
        $this->em()->persist($user);
        $this->em()->flush();

        //dispatch event
        $event = new FirstRegistrationEvent($user, $registrationDto->confirmationMode);
        $this->eventDispatcher->dispatch($event, FirstRegistrationEvent::NAME);

        return $this->successResponse('Code send to user', [], HttpStatus::CREATED);
    }

}