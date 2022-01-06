<?php


namespace App\Application\Trader\Command;


use App\Application\Trader\Dto\TraderDto;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Trader\Command
 */
class DisabledTraderCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function disabled(TraderDto $traderDto)
    {

    }
}