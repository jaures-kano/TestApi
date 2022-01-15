<?php

namespace App\Application\Profile\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Profile\Dto\RequestPasswordDto;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class ChangePasswordCommand
 * @package App\Application\ProfileDomain\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ResetPasswordCommand extends AbstractCase
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

    public function resetPassword(RequestPasswordDto $dto): CaseResponse
    {

        if ($this->keyService->isValidKey($dto->apiKey) === false) {
            return $this->errorResponse(CaseMessage::INVALID_KEY,
                [], HttpStatus::BADREQUEST);
        }

        if (!filter_var($dto->email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(CaseMessage::MAIL_INVALID,
                [], HttpStatus::BADREQUEST);
        }

        return $this->errorResponse('Reset code is not valid', []);
    }


}