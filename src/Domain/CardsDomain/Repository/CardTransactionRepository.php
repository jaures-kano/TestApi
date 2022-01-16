<?php

namespace App\Domain\CardsDomain\Repository;


use App\Domain\CardsDomain\Entity\CardTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CardTransactionRepository
 * @package App\Domain\CardsDomain\Repository
 * @author jaures kano <ruddyjaures@mail.com>
 * @method CardTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardTransaction[] findAll()
 * @method CardTransaction[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardTransactionRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardTransaction::class);
    }

}