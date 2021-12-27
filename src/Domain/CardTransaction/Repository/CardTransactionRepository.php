<?php

namespace App\Domain\CardTransaction\Repository;


use App\Domain\CardTransaction\Entity\CardTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CardTransactionRepository extends  ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardTransaction::class);
    }
}