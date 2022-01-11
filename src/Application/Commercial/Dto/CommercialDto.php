<?php


namespace App\Application\Commercial\Dto;


use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\Commercial\Entity\Commercial;
use DateTimeInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\CommercialDomain\Dto
 */
class CommercialDto
{

    public ?DateTimeInterface $updatedAt;
    public ?User $user;
    public ?DateTimeInterface $createdAt;
    public ?bool $isEnabled;

    public function __construct(?Commercial $commercial = null)
    {
        $this->user = $commercial == null? null : $commercial->getUser();
        $this->isEnabled = $commercial == null? null : $commercial->getIsEnabled();
        $this->createdAt = $commercial == null? null : $commercial->getCreatedAt();
        $this->updatedAt = $commercial == null? null : $commercial->getUpdatedAt();
    }
}