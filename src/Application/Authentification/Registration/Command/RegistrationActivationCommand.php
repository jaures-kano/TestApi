<?php

namespace App\Application\Authentification\Registration\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Authentification\Registration\Dto\RegistrationActivationDto;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationActivationCommand
 * @package App\Application\AuthRegistration\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationActivationCommand extends AbstractCase
{

    private UserRepository $userRepository;
    private EventDispatcherInterface $eventDispatcher;
    private KeyService $keyService;

    public function __construct(UserRepository           $userRepository,
                                KeyService               $keyService,
                                EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->keyService = $keyService;
    }

    public function activateAccount(RegistrationActivationDto $dto): CaseResponse
    {
        if ($this->keyService->isValidKey($dto->apiKey) === false) {
            return $this->errorResponse(CaseMessage::INVALID_KEY,
                [], HttpStatus::BADREQUEST);
        }

        return $this->errorResponse('Account activated', [], Response::HTTP_BAD_REQUEST);
    }

}