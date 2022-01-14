<?php 

namespace App\Domain\EnabledCountry\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\SubscriptionPlan\SubscriptionCountryFees\Entity\SubscriptionCountryFees;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;


/**
 * Class EnabledCountry
 * @package App\Domain\EnabledCountry\Entity
 * @author Catherine Mani<crescencegracemani@gmail.com>
 * @ORM\Entity
 */
class EnabledCountry
{

    use BaseTimeTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     * @Groups({"read:user"})
     */
    private ?Ulid $id;

    /**
     * @ORM\Column(type="string",length="255", nullable=false)
     * @Groups({"read:country"})
     */
    private string $name;


    /**
     * @ORM\Column(type="string",length="255",nullable=false)
     * @Groups({"read:country"})
     */
    private string $callingCode;

    /**
     * @ORM\Column(type="string",length="255",nullable=true)
     * @Groups({"read:country"})
     */
    private string $region;

    /**
     * @ORM\Column(type="string",length="255",nullable=true)
     * @Groups({"read:country"})
     */
    private string $subRegion;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read:country"})
     */
    private array $translations = [];

    /**
     * @ORM\Column(type="string", length="255",nullable=false)
     * @Groups({"read:country"})
     */
    private string $regexCode;

    /**
     * @ORM\Column( type="boolean", options={"default":true})
     * @Groups({"read:country"})
     */
    private bool $isEnabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\AuthDomain\Auth\Entity\User",mappedBy="enabledCountry" )
     */
    private Collection $users;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Domain\SubscriptionPlan\SubscriptionCountryFees\Entity\SubscriptionCountryFees",
     *     mappedBy="enabledCountry"
     * )
     */
    private Collection $subscriptionCountryFees;


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->subscriptionCountryFees = new ArrayCollection();
    }

    /**
     * Undocumented function
     *
     * @return Ulid
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getCallingCode(): ?string
    {
        return $this->callingCode;
    }

    /**
     * Undocumented function
     *
     * @param string $callingCode
     * @return self
     */
    public function setCallingCode(string $callingCode): self
    {
        $this->callingCode = $callingCode;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * Undocumented function
     *
     * @param string $region
     * @return self
     */
    public function setRegion(string $region): self
    {
        $this->region = $region;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getSubRegion(): string
    {
        return $this->subRegion;
    }

    /**
     * Undocumented function
     *
     * @param string $subRegion
     * @return self
     */
    public function setSubRegion(string $subRegion): self
    {
        $this->subRegion = $subRegion;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * Undocumented function
     *
     * @param array $translations
     * @return self
     */
    public function setTranslations(array $translations): self
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getRegexCode(): string
    {
        return $this->regexCode;
    }


    /**
     * Undocumented function
     *
     * @param string $regexCode
     * @return self
     */
    public function setRegexCode(string $regexCode): self
    {
        $this->regexCode = $regexCode;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return bool
     */
    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * Undocumented function
     *
     * @param bool $isEnabled
     * @return self
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return Collection|SubscriptionCountryFees[]
     */
    public function getSubscriptionCountryFees() :Collection
    {
        return $this->subscriptionCountryFees;
    }
}