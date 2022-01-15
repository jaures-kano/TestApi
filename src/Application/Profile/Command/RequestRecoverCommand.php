<?php

namespace App\Application\Profile\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Domain\ProfileDomain\Event\PasswordRequestEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class AccountRecoverCommand
 * @package App\Application\ProfileDomain\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RequestRecoverCommand extends AbstractCase
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


    public function recoverPassword($email, $mode = true, $apiKey): CaseResponse
    {
        if ($this->keyService->isValidKey($apiKey) === false) {
            return $this->errorResponse(CaseMessage::INVALID_KEY,
                [], HttpStatus::BADREQUEST);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(CaseMessage::MAIL_INVALID,
                [], HttpStatus::BADREQUEST);
        }

        $this->em()->persist($user);
        $this->em()->flush();

        $event = new PasswordRequestEvent($user, $mode);
        $this->eventDispatcher->dispatch($event, $event::NAME);

        $message = 'Un Email a ete envoye a votre avec un code de confirmation';
        $mode === false && $message = 'Un Sms a ete envoye a votre avec un code de confirmation';

        return $this->successResponse($message, []);

    }


}