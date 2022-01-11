<?php


namespace App\Application\Commercial\Command;


use App\Application\Commercial\Dto\CommercialDto;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\CommercialDomain\Command
 */
class EnableCommercialCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function enable(CommercialDto $commercialDto)
    {
    }
}