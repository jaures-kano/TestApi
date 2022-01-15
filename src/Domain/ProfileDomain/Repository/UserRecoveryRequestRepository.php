<?php

namespace App\Domain\ProfileDomain\Repository;


use App\Domain\ProfileDomain\Entity\UserRecoveryRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class UserRecovryRequestRepository
 * @package App\Domain\ProfileDomain\Repository
 * @author jaures kano <ruddyjaures@mail.com>
 * @method UserRecoveryRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserRecoveryRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserRecoveryRequest[]    findAll()
 * @method UserRecoveryRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRecoveryRequestRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserRecoveryRequest::class);
    }

    public function findIfActiveRequest()
    {
        $query = $this->createQueryBuilder('u');
        $query->andWhere('u.requestAt > ');
        return $query->getQuery()->getResult();
    }

}