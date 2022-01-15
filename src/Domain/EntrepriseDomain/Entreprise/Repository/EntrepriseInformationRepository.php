<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Repository;

use App\Domain\EntrepriseDomain\Entreprise\Entity\EntrepriseInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Repository
 * @method EntrepriseInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntrepriseInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntrepriseInformation[]    findAll()
 * @method EntrepriseInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntrepriseInformation::class);
    }
}