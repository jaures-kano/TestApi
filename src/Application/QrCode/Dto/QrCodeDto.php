<?php


namespace App\Application\QrCode\Dto;

use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\QrCodeDomain\QrCodeTransaction\Entity\QrCodeTransaction;
use DateTime;

/**
 * Class QrCodeDto
 * @package App\Application\QrCodeDomain\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class QrCodeDto
{
    public ?string $qrCode;
    public ?bool $isEnabled;
    public ?User $user;
    public ?DateTime $createdAt;
    public ?DateTime $updatedAt;

    /**
     * QrCodeDto constructor.
     * @param QrCodeTransaction|null $qrCode
     */
    public function __construct(?QrCodeTransaction $qrCode = null)
    {
        $this->qrCode = $qrCode === null ? null : $qrCode->getQrCode();
        $this->user = $qrCode === null ? null : $qrCode->getUser();
        $this->isEnabled = $qrCode === null ? null : $qrCode->getIsEnabled();
        $this->createdAt = $qrCode === null ? null : $qrCode->getCreatedAt();
        $this->updatedAt = $qrCode === null ? null : $qrCode->getUpdatedAt();
    }
}