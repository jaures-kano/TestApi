<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Repository;

use App\Domain\EntrepriseDomain\Entreprise\Entity\EntrepriseOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Repository
 * @method EntrepriseOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntrepriseOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntrepriseOwner[]    findAll()
 * @method EntrepriseOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseOwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntrepriseOwner::class);
    }
}