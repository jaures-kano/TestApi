<?php

namespace App\Application\Profile\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\Response\CaseResponse;
use App\Domain\Auth\Entity\User;
use App\Domain\Profile\Event\PasswordRequestEvent;
use App\Infrastructures\Generator\PasswordResetGenerator;
use DateTime;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class AccountRecoverCommand
 * @package App\Application\ProfileDomain\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class AccountRecoverCommand extends AbstractCase
{

    private EventDispatcherInterface $eventDispatcher;
    private UserPasswordHasherInterface $hasher;


    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, UserPasswordHasherInterface $hasher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->hasher = $hasher;
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

    public function resetPassword(User $user, string $code, string $password): CaseResponse
    {
        if ($user->getResetCode() === (float)$code) {
            $user->setPassword($this->hasher->hashPassword($user, $password));
            $user->setUpdatedAt(new DateTime());
            $user->setResetTime(null);
            $user->setResetCode(null);
            $this->em()->persist($user);
            $this->em()->flush();
            return $this->successResponse('User password is reset', []);
        }

        return $this->errorResponse('Reset code is not valid', []);
    }
}