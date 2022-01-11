<?php


namespace App\Application\Partner\Dto;


use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\Partner\Entity\Partner;
use DateTimeInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\PartnerDomain\Dto
 */
class PartnerDto
{
    public ?DateTimeInterface $updatedAt;
    public ?DateTimeInterface $createdAt;
    public ?string $code;
    public ?User $user;

    public function __construct(Partner $partner = null)
    {
        $this->user = $partner == null ? null : $partner->getUser();
        $this->code = $partner == null ? null : $partner->getCode();
        $this->createdAt = $partner == null ? null : $partner->getCreatedAt();
        $this->updatedAt = $partner == null ? null : $partner->getUpdatedAt();
    }
}
