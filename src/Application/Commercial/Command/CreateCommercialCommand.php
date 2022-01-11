<?php


namespace App\Application\Commercial\Command;


use App\Application\Commercial\Dto\CommercialDto;
use App\Domain\Commercial\Entity\Commercial;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\CommercialDomain\Command
 */
class CreateCommercialCommand
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function create(CommercialDto $commercialDto)
    {
        $commercial = new Commercial();

        $commercial->setUser($commercialDto->user)
            ->setIsEnabled(true)
            ->setCreatedAt(new DateTime())
            ;
        $this->manager->persist($commercial);
        $this->manager->flush();
    }
}