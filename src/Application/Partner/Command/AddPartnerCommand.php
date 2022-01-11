<?php


namespace App\Application\Partner\Command;


use App\Application\Partner\Dto\PartnerDto;
use App\Domain\Partner\Entity\Partner;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\PartnerDomain\Command
 */
class AddPartnerCommand
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function add(PartnerDto $partnerDto)
    {
        $partner = new Partner();

        $partner->setUser($partnerDto->user)
            ->setCode($partnerDto->code)
            ->setCreatedAt(new DateTime());

        $this->manager->persist($partner);
        $this->manager->flush();
    }
}