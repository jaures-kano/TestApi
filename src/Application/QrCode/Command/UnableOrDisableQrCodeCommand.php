<?php


namespace App\Application\QrCode\Command;


use App\Adapter\Response\CaseResponse;
use App\Application\QrCode\Dto\QrCodeTransactionDto;
use App\Domain\QrCodeDomain\Entity\QrCodeTransaction;
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
     * @param QrCodeTransactionDto $qrCodeDto
     * @param QrCodeTransaction $qrCode
     * @return CaseResponse
     */
    public function UnableOrDisable(QrCodeTransactionDto $qrCodeDto, QrCodeTransaction $qrCode): caseResponse
    {
        $qrCode->setIsEnabled(true);
        $this->manager->flush();
        return new CaseResponse(true, "Le QrCodeDomain à bien été activé", [$qrCode]);
    }
}