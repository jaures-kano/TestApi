<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Entity;


use App\Domain\AuthDomain\Auth\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\EntrepriseDomain\Entreprise\Repository\EntrepriseOwnerRepository;
use Symfony\Component\Uid\Ulid;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;

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
     * @ORM\ManyToOne(targetEntity=EntrepriseInformation::class, inversedBy="owner")
     */
    private ?EntrepriseInformation $entreprise = null;

    /**
     * @ORM\ManyToOne(targetEntity=EntrepriseOwnerType::class, inversedBy="owner")
     */
    private EntrepriseOwnerType $ownerType;

    /**
     * @return Ulid|null
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return EntrepriseOwner
     */
    public function setUser(?User $user): EntrepriseOwner
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return EntrepriseInformation|null
     */
    public function getEntreprise(): ?EntrepriseInformation
    {
        return $this->entreprise;
    }

    /**
     * @param EntrepriseInformation|null $entreprise
     * @return EntrepriseOwner
     */
    public function setEntreprise(?EntrepriseInformation $entreprise): EntrepriseOwner
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return EntrepriseOwnerType
     */
    public function getOwnerType(): EntrepriseOwnerType
    {
        return $this->ownerType;
    }

    /**
     * @param EntrepriseOwnerType $ownerType
     * @return EntrepriseOwner
     */
    public function setOwnerType(EntrepriseOwnerType $ownerType): EntrepriseOwner
    {
        $this->ownerType = $ownerType;

        return $this;
    }

}