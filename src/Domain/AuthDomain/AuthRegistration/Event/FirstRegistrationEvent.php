<?php

namespace App\Domain\AuthDomain\AuthRegistration\Event;


use App\Domain\AuthDomain\Auth\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class FirstRegistrationEvent
 * @package App\Domain\AuthRegistration\Event
 * @author jaures kano <ruddyjaures@mail.com>
 */
class FirstRegistrationEvent extends Event
{

    public const NAME = 'onFirstRegistrationEvent';

    protected User $user;

    protected bool $mode;

    public function __construct(User $user, bool $mode)
    {
        $this->user = $user;
        $this->mode = $mode;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getMode(): bool
    {
        return $this->mode;
    }

}