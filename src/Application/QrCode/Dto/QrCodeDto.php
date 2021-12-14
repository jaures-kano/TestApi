<?php


namespace App\Application\QrCode\Dto;

use App\Domain\Auth\Entity\User;

/**
 * Class QrCodeDto
 * @package App\Application\QrCode\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class QrCodeDto
{
    public ?string $qrCode;
    public ?bool $isEnabled;
    public ?User $user;
    public ?\DateTime $createdAt;
    public ?\DateTime $updatedAt;

    /**
     * QrCodeDto constructor.
     * @param QrCode|null $qrCode
     */
    public function __construct(?QrCode $qrCode = null)
    {
        $this->qrCode = $qrCode === null ? null : $qrCode->getQrCode();
        $this->user = $qrCode === null ? null : $qrCode->getUser();
        $this->isEnabled = $qrCode === null ? null : $qrCode->getIsEnable();
        $this->createdAt = $qrCode === null ? null : $qrCode->getCreatedAt();
        $this->updatedAt = $qrCode === null ? null : $qrCode->getUpdatedAt();
    }
}