<?php

namespace App\Domain\AuthDomain\Auth\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Traits\AuthSystems;
use App\Domain\AuthDomain\Auth\Traits\IdentityVerified;
use App\Domain\AuthDomain\Auth\Traits\ProccessorInfo;
use App\Domain\AuthDomain\Auth\Traits\UserLocationInformation;
use App\Domain\AuthDomain\Auth\Traits\UserPersonnalInformation;
use App\Domain\CommercialDomain\Entity\Commercial;
use App\Domain\EnabledCountry\Entity\EnabledCountry;
use App\Domain\PartnerDomain\Entity\Partner;
use App\Domain\SubscriptionPlan\Subscription\Entity\Subscription;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;

/**
 * @ORM\Entity(repositoryClass="App\Domain\AuthDomain\Auth\Repository\UserRepository")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, Serializable
{
    use AuthSystems;
    use IdentityVerified;
    use ProccessorInfo;
    use UserPersonnalInformation;
    use UserLocationInformation;
    use BaseTimeTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     * @Groups({"read:user"})
     */
    private ?Ulid $id = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read:user"})
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read:user"})
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\EnabledCountry\Entity\EnabledCountry",
     *     inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private EnabledCountry $enabledCountry;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\QrCodeDomain\QrCodeTransaction\Entity\QrCodeTransaction",
     *     mappedBy="user" )
     */
    private Collection $qrCodes;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\CardsDomain\Card\Entity\Card",
     *     mappedBy="user" )
     */
    private Collection $cards;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\CardsDomain\CardTransaction\Entity\CardTransaction",
     *     mappedBy="users" )
     */
    private Collection $cardTransactions;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\CommercialDomain\Entity\Commercial", mappedBy="user")
     */
    private ?Commercial $commercial;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\PartnerDomain\Entity\Partner", mappedBy="user")
     */
    private ?Partner $partner;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Trader\Entity\Trader", mappedBy="user")
     */
    private Collection $trader;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\SubscriptionPlan\Subscription\Entity\Subscription",
     *      inversedBy="users")
     */
    private Subscription $subscription;


    public function __construct()
    {
        $this->trader = new ArrayCollection();
        $this->qrCodes = new ArrayCollection();
        $this->cards = new ArrayCollection();
        $this->cardTransactions = new ArrayCollection();
    }

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        // guarantee every user at least has ROLE_USER
        $this->roles[] = 'ROLE_USER';

        return array_unique($this->roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getQrCodes(): Collection
    {
        return $this->qrCodes;
    }

    /**
     * @return EnabledCountry
     */
    public function getEnabledCountry(): EnabledCountry
    {
        return $this->enabledCountry;
    }

    public function setEnabledCountry(EnabledCountry $enabledCountry): self
    {
        $this->enabledCountry = $enabledCountry;
        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized): void
    {
        [
            $this->id,
            $this->email,
            $this->password,
        ] = unserialize($serialized);
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getPhoneVerfiedAt(): ?DateTimeInterface
    {
        return $this->phoneVerfiedAt;
    }

    /**
     * @param DateTimeInterface|null $phoneVerfiedAt
     * @return User
     */
    public function setPhoneVerfiedAt(?DateTimeInterface $phoneVerfiedAt): User
    {
        $this->phoneVerfiedAt = $phoneVerfiedAt;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getCards():Collection
    {
        return $this->cards;
    }


    /**
     * @return ArrayCollection|Collection
     */
    public function getCardTransactions():Collection
    {
        return $this->cardTransactions;
    }

    /**
     * @return Commercial|null
     */
    public function getCommercial(): ?Commercial
    {
        return $this->commercial;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getTrader() : Collection
    {
        return $this->trader;
    }

    /**
     * @return Partner|null
     */
    public function getPartner(): ?Partner
    {
        return $this->partner;
    }


    /*
     * @return Subscription
     */
    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    /**
     * @param Subscription $subscription
     * @return User
     */
    public function setSubscription(Subscription $subscription): self
    {
        $this->subscription = $subscription;
        return $this;
    }

}