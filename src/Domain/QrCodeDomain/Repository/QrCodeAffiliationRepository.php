<?php

namespace App\Domain\QrCodeDomain\Repository;


use App\Domain\QrCodeDomain\Entity\QrCodeAffiliation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class EnabledCountryRepository
 * @method QrCodeAffiliation|null find($id, $lockMode = null, $lockVersion = null)
 * @method QrCodeAffiliation|null findOneBy(array $criteria, array $orderBy = null)
 * @method QrCodeAffiliation[]    findAll()
 * @method QrCodeAffiliation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @package App\Domain\EnabledCountry\Repository
 * @author Catherine Mani <crescencegracemani@gmail.com>
 */
class QrCodeAffiliationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QrCodeAffiliation::class);
    }

}