<?php

namespace App\Infrastructures\Generator;


use App\Domain\AuthDomain\Auth\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ConfirmationAccountGenerator
 * @package App\Infrastructures\Generator
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ConfirmationAccountGenerator extends AbstractController
{

    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function confirmCode(): float
    {
        return $this->code();
    }

    private function code(): float
    {
        $lastLoginTime = new DateTime();
        $y = (float)$lastLoginTime->format('Y');
        $m = (float)$lastLoginTime->format('m');
        $d = (float)$lastLoginTime->format('d');
        $h = (float)$lastLoginTime->format('H');
        $i = (float)$lastLoginTime->format('I');
        return ($y + $m + $d) * ($h + $i);
    }

    public function isResetCodeValid(float $code): bool
    {
        return $this->code() === $code;
    }

}