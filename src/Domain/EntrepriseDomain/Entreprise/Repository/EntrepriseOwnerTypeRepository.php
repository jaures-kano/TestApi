<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Repository;


use App\Domain\EntrepriseDomain\Entreprise\Entity\EntrepriseOwnerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Repository
 * @method EntrepriseOwnerType|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntrepriseOwnerType|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntrepriseOwnerType[]    findAll()
 * @method EntrepriseOwnerType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseOwnerTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntrepriseOwnerType::class);
    }
}