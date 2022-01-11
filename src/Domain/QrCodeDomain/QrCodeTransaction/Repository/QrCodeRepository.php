<?php

namespace App\Domain\QrCodeDomain\QrCodeTransaction\Repository;


use App\Domain\QrCodeDomain\QrCodeTransaction\Entity\QrCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class EnabledCountryRepository
 * @method QrCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method QrCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method QrCode[]    findAll()
 * @method QrCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @package App\Domain\EnabledCountry\Repository
 * @author Catherine Mani <crescencegracemani@gmail.com>
 */
class QrCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QrCode::class);
    }

}