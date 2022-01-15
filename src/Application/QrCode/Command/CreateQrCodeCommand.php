<?php


namespace App\Application\QrCode\Command;


use App\Adapter\Response\CaseResponse;
use App\Application\QrCode\Dto\QrCodeDto;
use App\Domain\QrCodeDomain\Entity\QrCodeTransaction;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class CreateQrCodeCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function createQrCode(QrCodeDto $qrCodeDto): caseResponse
    {
        $qrCode = new QrCodeTransaction();

        $qrCode->setQrCode('test')
            ->setIsEnabled(true)
            ->setIsEnabled(true)
            ->setCreatedAt(new DateTime());
//            ->setUser($qrCodeDto->user);

        $this->manager->persist($qrCode);
        $this->manager->flush();

        return new CaseResponse(true, "le QrCodeDomain à bien été généré", [$qrCode]);
    }
}