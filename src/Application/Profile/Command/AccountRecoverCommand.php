<?php

namespace App\Application\Profile\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\Response\CaseResponse;
use App\Domain\Auth\Entity\User;
use App\Domain\Profile\Event\PasswordRequestEvent;
use App\Infrastructures\Generator\PasswordResetGenerator;
use DateTime;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class AccountRecoverCommand
 * @package App\Application\Profile\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class AccountRecoverCommand extends AbstractCase
{

    private EventDispatcherInterface $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }


    public function recoverPassword(User $user, $mode = true): CaseResponse
    {
        $generator = new PasswordResetGenerator($user);
        $user->setResetCode($generator->resetPasswordCode());
        $user->setResetTime(new DateTime('+30 minutes'));
        $this->em()->persist($user);
        $this->em()->flush();

        $event = new PasswordRequestEvent($user, $mode);
        $this->eventDispatcher->dispatch($event, $event::NAME);

        $message = 'Un Email a ete envoye a votre avec un code de confirmation';
        $mode === false && $message = 'Un Sms a ete envoye a votre avec un code de confirmation';

        return $this->successResponse($message, []);
    }

}