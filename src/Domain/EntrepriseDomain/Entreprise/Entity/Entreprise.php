<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Entity;

use App\Domain\EntrepriseDomain\Entreprise\Repository\EntrepriseRepository;
use App\Domain\EntrepriseDomain\EntrepriseClient\Entity\EntrepriseAffiliation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Entity
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
    private ?string $description;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseOwner::class, mappedBy="entreprise")
     */
    private Collection $owner;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseAffiliation::class, mappedBy="entreprise")
     */
    private Collection $entrepriseAffiliation;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\EntrepriseDomain\EntreprisePrestation\Entity\EntreprisePrestation",
     *     mappedBy="entreprise")
     */
    private Collection $prestations;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\CardsDomain\Entity\Card",
     *     mappedBy="entreprise" )
     */
    private Collection $cards;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\QrCodeDomain\Entity\QrCodeAffiliation",
     *     mappedBy="entreprise" )
     */
    private Collection $qrCodes;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\QrCodeDomain\Entity\QrCodeTransaction",
     *     mappedBy="entreprise" )
     */
    private Collection $qrCodesTransaction;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
        $this->entrepriseAffiliation = new ArrayCollection();
        $this->owner = new ArrayCollection();
        $this->cards = new ArrayCollection();
        $this->qrCodes = new ArrayCollection();
        $this->qrCodesTransaction = new ArrayCollection();
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
     * @return Entreprise
     */
    public function setName(?string $name): Entreprise
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
     * @return Entreprise
     */
    public function setEmail(?string $email): Entreprise
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
     * @return Entreprise
     */
    public function setNumber(?string $number): Entreprise
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
     * @return Entreprise
     */
    public function setDescription(?string $description): Entreprise
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
    public function getPrestations()
    {
        return $this->prestations;
    }

    /**
     * @return Collection|null
     */
    public function getCards()
    {
        return $this->cards;
    }

    public function getQrCodes()
    {
        return $this->qrCodes;
    }

    public function getQrCodesTransaction()
    {
        return $this->qrCodesTransaction;
    }
}