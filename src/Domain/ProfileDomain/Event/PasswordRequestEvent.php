<?php

namespace App\Domain\ProfileDomain\Event;


use App\Domain\AuthDomain\Auth\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class PasswordRequestEvent
 * @package App\Domain\ProfileDomain\Event
 * @author jaures kano <ruddyjaures@mail.com>
 */
class PasswordRequestEvent extends Event
{

    public const NAME = 'onResetPasswordRequest';

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