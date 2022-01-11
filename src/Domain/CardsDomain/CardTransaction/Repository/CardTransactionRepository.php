<?php

namespace App\Domain\CardsDomain\CardTransaction\Repository;

use App\Domain\CardsDomain\CardTransaction\Entity\CardTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method CardTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardTransaction[]    findAll()
 * @method CardTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardTransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardTransaction::class);
    }
}