<?php


namespace App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Repository;


use App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Entity\EntrepriseProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Repository
 * @method EntrepriseProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntrepriseProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntrepriseProduct[]    findAll()
 * @method EntrepriseProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntrepriseProduct::class);
    }
}