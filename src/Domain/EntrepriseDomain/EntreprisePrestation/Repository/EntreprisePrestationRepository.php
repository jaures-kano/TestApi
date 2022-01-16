<?php


namespace App\Domain\EntrepriseDomain\EntreprisePrestation\Repository;


use App\Domain\EntrepriseDomain\EntreprisePrestation\Entity\EntreprisePrestation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntreprisePrestation\EntreprisePrestation\Repository
 * @method EntreprisePrestation|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntreprisePrestation|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntreprisePrestation[]    findAll()
 * @method EntreprisePrestation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntreprisePrestationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntreprisePrestation::class);
    }
}