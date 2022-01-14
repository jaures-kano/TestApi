<?php

namespace App\Domain\AppKeysDomain\Repository;


use App\Domain\AppKeysDomain\Entity\ApplicationKey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ApplicationKeyRepository
 * @package App\Domain\AppKeysDomain\Repository
 * @author jaures kano <ruddyjaures@mail.com>
 * @method ApplicationKey|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationKey|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationKey[]    findAll()
 * @method ApplicationKey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationKeyRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationKey::class);
    }
}