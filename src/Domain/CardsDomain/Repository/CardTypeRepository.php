<?php

namespace App\Domain\CardsDomain\Repository;

use App\Domain\CardsDomain\Entity\CardType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CardTypeRepository
 * @package App\Domain\CardsDomain\Repository
 * @author jaures kano <ruddyjaures@mail.com>
 * @method CardType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardType[] findAll()
 * @method CardType[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardTypeRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardType::class);
    }

}