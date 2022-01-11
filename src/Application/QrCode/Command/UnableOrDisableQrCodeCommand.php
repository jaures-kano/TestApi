<?php


namespace App\Application\QrCode\Command;


use App\Adapter\Response\CaseResponse;
use App\Application\QrCode\Dto\QrCodeDto;
use App\Domain\QrCodeDomain\QrCodeTransaction\Entity\QrCode;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UnableOrDisableQrCodeCommand
 * @package App\Application\QrCodeDomain\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class UnableOrDisableQrCodeCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param QrCodeDto $qrCodeDto
     * @param QrCode $qrCode
     * @return CaseResponse
     */
    public function UnableOrDisable(QrCodeDto $qrCodeDto, QrCode $qrCode): caseResponse
    {
        if ($qrCodeDto->isEnabled) {
            $qrCode->setIsEnabled(false);
            $this->manager->flush();
            return new CaseResponse(true, "Le QrCodeDomain a bien été desactivé", [$qrCode]);
        }
        $qrCode->setIsEnabled(true);
        $this->manager->flush();
        return new CaseResponse(true, "Le QrCodeDomain à bien été activé", [$qrCode]);
    }
}