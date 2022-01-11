<?php


namespace App\Application\Trader\Dto;


use App\Domain\Auth\Entity\User;
use App\Domain\Trader\Entity\Trader;
use DateTimeInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Trader\Dto
 */
class TraderDto
{

    public ?User $user;
    public ?bool $isEnabled;
    public ?DateTimeInterface $createdAt;
    public ?DateTimeInterface $UpdatedAt;

    public function __construct(?Trader $trader = null)
    {
        $this->user = $trader === null? null : $trader->getUser();
        $this->isEnabled = $trader === null? null : $trader->getIsEnabled();
        $this->createdAt = $trader === null? null : $trader->getCreatedAt();
        $this->UpdatedAt = $trader === null? null : $trader->getUpdatedAt();
    }
}