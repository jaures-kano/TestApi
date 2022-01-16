<?php


namespace App\Domain\EntrepriseDomain\EntreprisePrestation\Repository;


use App\Domain\EntrepriseDomain\EntreprisePrestation\Entity\EntreprisePromotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntreprisePrestation\EntreprisePrestation\Repository
 * @method EntreprisePromotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntreprisePromotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntreprisePromotion[]    findAll()
 * @method EntreprisePromotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntreprisePromotionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntreprisePromotion::class);
    }
}