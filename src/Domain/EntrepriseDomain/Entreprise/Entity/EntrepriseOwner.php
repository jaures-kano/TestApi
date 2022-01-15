<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Entity;


use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\EntrepriseDomain\Entreprise\Repository\EntrepriseOwnerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Entity
 * @ORM\Entity(repositoryClass=EntrepriseOwnerRepository::class)
 */
class EntrepriseOwner
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "ulid", unique = true)
     * @ORM\GeneratedValue(strategy = "CUSTOM")
     * @ORM\CustomIdGenerator(class = UlidGenerator::class)
     */
    private ?Ulid $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="entrepriseOwner")
     */
    private ?User $user = null;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="owner")
     */
    private ?Entreprise $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=EntrepriseOwnerType::class, inversedBy="owner")
     */
    private EntrepriseOwnerType $ownerType;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): EntrepriseOwner
    {
        $this->user = $user;

        return $this;
    }


    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): EntrepriseOwner
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getOwnerType(): EntrepriseOwnerType
    {
        return $this->ownerType;
    }

    public function setOwnerType(EntrepriseOwnerType $ownerType): EntrepriseOwner
    {
        $this->ownerType = $ownerType;

        return $this;
    }

}