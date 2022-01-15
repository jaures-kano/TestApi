<?php


namespace App\Domain\EntrepriseDomain\EntrepriseClient\Repository;


use App\Domain\EntrepriseDomain\EntrepriseClient\Entity\EntrepriseAffiliation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Repository
 * @method EntrepriseAffiliation|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntrepriseAffiliation|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntrepriseAffiliation[]    findAll()
 * @method EntrepriseAffiliation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseAffiliationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntrepriseAffiliation::class);
    }
}