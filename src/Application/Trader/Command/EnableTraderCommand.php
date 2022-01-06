<?php


namespace App\Application\Trader\Command;


use App\Application\Commercial\Dto\CommercialDto;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Trader\Command
 */
class EnableTraderCommand
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