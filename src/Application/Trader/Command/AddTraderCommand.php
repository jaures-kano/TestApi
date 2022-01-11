<?php


namespace App\Application\Trader\Command;


use App\Application\Trader\Dto\TraderDto;
use App\Domain\Commercial\Entity\Commercial;
use App\Domain\Trader\Entity\Trader;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Trader\Command
 */
class AddTraderCommand
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function add(TraderDto $traderDto)
     {
         $user = $traderDto->user;

         if (!$user->getCommercial() instanceof Commercial){
             return;
         }

         $trader = new Trader();

         $trader->setUser($user)
             ->setCreatedAt(new DateTime())
             ->setIsEnabled(true);
         ;

         $this->manager->persist($trader);
         $this->manager->flush();
     }
}