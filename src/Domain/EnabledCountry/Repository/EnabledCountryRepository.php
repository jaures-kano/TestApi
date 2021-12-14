<?php


namespace App\Domain\EnabledCountry\Repository;

use App\Domain\EnabledCountry\Entity\EnabledCountry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * Class EnabledCountryRepository
 * @method EnabledCountry|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnabledCountry|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnabledCountry[]    findAll()
 * @method EnabledCountry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @package App\Domain\EnabledCountry\Repository
 * @author Catherine Mani <crescencegracemani@gmail.com>
 */
class EnabledCountryRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnabledCountry::class);
    }

}