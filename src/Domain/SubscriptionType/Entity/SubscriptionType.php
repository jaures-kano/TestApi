<?php

namespace App\Domain\SubscriptionType\Entity;

use App\Application\Traits\BaseTimeTrait;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Auth\Entity\User;
use App\Domain\CardTransaction\Entity\CardTransaction;
use App\Domain\Subscription\Entity\Subscription;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;

class SubscriptionType
{

    use BaseTimeTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var int
     * @ORM\Column(type="int")
     */
    private int $nom;

    /**
     * @var bool
     *  @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $buy;

    /**
     * @var bool
     *  @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $withdrawal;

    /**
     * @var bool
     *  @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $transfer;


    /**
     * @ORM\ManyToOne(targetEntity=EnabledCountry::class, inversedBy="subscriptionTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private Subscription $subscription;

    /**
     * @ORM\OneToMany (targetEntity=EnabledCountry::class,mappedBy="subscriptionType")
     */
    private Collection $subscriptionCountryFees;


    public function __construct()
     {
        $this->subscriptionCountryFees = new ArrayCollection();
      }
    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     * @return SubscriptionType
     */
    public function setCreatedAt(DateTimeInterface $createdAt): SubscriptionType
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SubscriptionType
     */
    public function setId(int $id): SubscriptionType
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNom(): int
    {
        return $this->nom;
    }

    /**
     * @param int $nom
     * @return SubscriptionType
     */
    public function setNom(int $nom): SubscriptionType
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBuy(): bool
    {
        return $this->buy;
    }

    /**
     * @param bool $buy
     * @return SubscriptionType
     */
    public function setBuy(bool $buy): SubscriptionType
    {
        $this->buy = $buy;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWithdrawal(): bool
    {
        return $this->withdrawal;
    }

    /**
     * @param bool $withdrawal
     * @return SubscriptionType
     */
    public function setWithdrawal(bool $withdrawal): SubscriptionType
    {
        $this->withdrawal = $withdrawal;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTransfer(): bool
    {
        return $this->transfer;
    }

    /**
     * @param bool $transfer
     * @return SubscriptionType
     */
    public function setTransfer(bool $transfer): SubscriptionType
    {
        $this->transfer = $transfer;
        return $this;
    }

    /**
     * @return Subscription
     */
    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    /**
     * @param Subscription $subscription
     * @return SubscriptionType
     */
    public function setSubscription(Subscription $subscription): self
    {
        $this->subscription = $subscription;
        return $this;
    }

    public function getSubscriptionCountryFees(): Collection
    {
        return $this -> subscriptionCountryFees;
    }


}