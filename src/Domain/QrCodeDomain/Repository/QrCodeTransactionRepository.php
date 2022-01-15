<?php

namespace App\Domain\QrCodeDomain\Repository;


use App\Domain\QrCodeDomain\Entity\QrCodeTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class EnabledCountryRepository
 * @method QrCodeTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method QrCodeTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method QrCodeTransaction[]    findAll()
 * @method QrCodeTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @package App\Domain\EnabledCountry\Repository
 * @author Catherine Mani <crescencegracemani@gmail.com>
 */
class QrCodeTransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QrCodeTransaction::class);
    }

}