<?php

namespace App\Domain\SubscriptionPlan\SubscriptionType\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\SubscriptionPlan\Subscription\Entity\Subscription;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;


/**
 * @ORM\Entity
 */
class SubscriptionType
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
     * @var string
     * @ORM\Column(type="string")
     */
    private string $designation;

    /**
     * @var bool
     * @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $buy;

    /**
     * @var bool
     * @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $withdrawal;

    /**
     * @var bool
     * @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $transfer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\SubscriptionPlan\Subscription\Entity\Subscription",
     *     inversedBy="subscriptionTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private Subscription $subscription;

    /**
     * @ORM\OneToMany (targetEntity="App\Domain\SubscriptionPlan\SubscriptionCountryFees\Entity\SubscriptionCountryFees",
     *     mappedBy="subscriptionType")
     */
    private Collection $subscriptionCountryFees;


    public function __construct()
    {
        $this->subscriptionCountryFees = new ArrayCollection();
    }

    /**
     * @return Ulid
     */
    public function getId(): Ulid
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getDesignation(): string
    {
        return $this->designation;
    }

    /**
     * @param string $designation
     * @return SubscriptionType
     */
    public function setDesignation(string $designation): SubscriptionType
    {
        $this->designation = $designation;
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
    public function setSubscription(Subscription $subscription): SubscriptionType
    {
        $this->subscription = $subscription;
        return $this;
    }


}