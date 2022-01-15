<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Entity;

use App\Domain\EntrepriseDomain\Entreprise\Repository\EntrepriseOwnerTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Entity
 * @ORM\Entity(repositoryClass=EntrepriseOwnerTypeRepository::class)
 */
class EntrepriseOwnerType
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "ulid", unique = true)
     * @ORM\GeneratedValue(strategy = "CUSTOM")
     * @ORM\CustomIdGenerator(class = UlidGenerator::class)
     */
    private ?Ulid $id = null;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private ?string $designation;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): EntrepriseOwnerType
    {
        $this->designation = $designation;

        return $this;
    }

}