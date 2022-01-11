<?php


namespace App\Application\Commercial\Command;


use App\Application\Commercial\Dto\CommercialDto;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Commercial\Command
 */
class DisabledCommercialCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function disabled(CommercialDto $commercialDto)
    {

    }
}