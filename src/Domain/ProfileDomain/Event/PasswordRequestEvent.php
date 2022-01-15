<?php

namespace App\Domain\ProfileDomain\Event;


use App\Domain\ProfileDomain\Entity\UserRecoveryRequest;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class PasswordRequestEvent
 * @package App\Domain\ProfileDomain\Event
 * @author jaures kano <ruddyjaures@mail.com>
 */
class PasswordRequestEvent extends Event
{

    public const NAME = 'onResetPasswordRequest';

    protected UserRecoveryRequest $userRecoveryRequest;

    protected bool $mode;

    public function __construct(UserRecoveryRequest $userRecoveryRequest, bool $mode)
    {
        $this->userRecoveryRequest = $userRecoveryRequest;
        $this->mode = $mode;
    }

    public function getUserRequest(): UserRecoveryRequest
    {
        return $this->userRecoveryRequest;
    }

    public function getMode(): bool
    {
        return $this->mode;
    }
}