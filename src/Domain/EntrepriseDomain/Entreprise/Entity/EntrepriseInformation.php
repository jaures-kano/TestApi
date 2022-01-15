<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Entity;

use App\Domain\EntrepriseDomain\Entreprise\Repository\EntrepriseInformationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Entity
 * @ORM\Entity(repositoryClass=EntrepriseInformationRepository::class)
 */
class EntrepriseInformation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private ?Ulid $id = null;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private ?string $number;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description=null;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseOwner::class, mappedBy="entreprise")
     */
    private Collection $owner;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseAffiliation::class, mappedBy="entreprise")
     */
    private ?Collection $entrepriseAffiliation = null;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseProduct::class, mappedBy="entreprise")
     */
    private ?Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->entrepriseAffiliation = new ArrayCollection();
        $this->owner = new ArrayCollection();
    }

    /**
     * @return Ulid|null
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return EntrepriseInformation
     */
    public function setName(?string $name): EntrepriseInformation
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return EntrepriseInformation
     */
    public function setEmail(?string $email): EntrepriseInformation
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     * @return EntrepriseInformation
     */
    public function setNumber(?string $number): EntrepriseInformation
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return EntrepriseInformation
     */
    public function setDescription(?string $description): EntrepriseInformation
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return Collection|null
     */
    public function getEntrepriseAffiliation()
    {
        return $this->entrepriseAffiliation;
    }

    /**
     * @return Collection|null
     */
    public function getProducts()
    {
        return $this->products;
    }

}