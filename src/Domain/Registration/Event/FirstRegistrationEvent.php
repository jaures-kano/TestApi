<?php

namespace App\Domain\Registration\Event;


use App\Domain\Auth\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class FirstRegistrationEvent
 * @package App\Domain\Registration\Event
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