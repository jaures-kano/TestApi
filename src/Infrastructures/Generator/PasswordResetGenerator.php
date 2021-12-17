<?php

namespace App\Infrastructures\Generator;


use App\Domain\Auth\Entity\User;

/**
 * Class PasswordResetGenerator
 * @package App\Infrastructures\Generator
 * @author jaures kano <ruddyjaures@mail.com>
 */
class PasswordResetGenerator
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function resetPasswordCode(): float
    {
        return $this->code();
    }

    private function code(): float
    {
        $lastLoginTime = $this->user->getLastLoginAt() ?? $this->user->getCreatedAt();
        $y = (float)$lastLoginTime->format('Y');
        $m = (float)$lastLoginTime->format('m');
        $d = (float)$lastLoginTime->format('d');
        $h = (float)$lastLoginTime->format('H');
        $i = (float)$lastLoginTime->format('I');
        return $y + $m + $d + $h + $i;
    }

    public function isResetCodeValid(float $code): bool
    {
        return $this->code() === $code;
    }
}