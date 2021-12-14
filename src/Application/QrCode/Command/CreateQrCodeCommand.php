<?php


namespace App\Application\QrCode\Command;


use App\Adapter\Response\CaseResponse;
use App\Application\QrCode\Dto\QrCodeDto;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class CreateQrCodeCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function create(QrCodeDto $qrCodeDto) : caseResponse
    {
        $qrCode = new QrCode();
        $qrCode->setQrCode($$qrCodeDto->qrCode)
            ->setUser($qrCodeDto->user)
            ->setIsEnabled($qrCodeDto->isEnabled)
            ->setCreatedAt(new DateTime('now'))
        ;

        $this->manager->persist($qrCode);
        $this->manager->flush();

        return new CaseResponse(true, "le QrCode à bien été généré", [$qrCode]);
    }
}