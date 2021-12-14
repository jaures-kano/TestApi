<?php


namespace App\Application\QrCode\Command;


use App\Adapter\Response\CaseResponse;
use App\Application\QrCode\Dto\QrCodeDto;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UnableOrDisableQrCodeCommand
 * @package App\Application\QrCode\Command
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
    public function UnableOrDisable(QrCodeDto $qrCodeDto,QrCode $qrCode): caseResponse
    {
        if($qrCodeDto->isEnabled)
        {
            $qrCode->setIsEnable(false);
            $this->manager->flush();
            return new CaseResponse(true, "Le QrCode a bien été desactivé", [$qrCode]);
        }
        $qrCode->setIsEnable(true);
        $this->manager->flush();
        return new CaseResponse(true, "Le QrCode à bien été activé", [$qrCode]);
    }
}