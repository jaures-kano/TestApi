<?php

namespace App\Domain\SubscriptionPlan\SubscriptionCountryFees\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\EnabledCountry\Entity\EnabledCountry;
use App\Domain\SubscriptionPlan\SubscriptionType\Entity\SubscriptionType;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class SubscriptionCountryFees
{
    use BaseTimeTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $currency;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private float $fees;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\SubscriptionPlan\SubscriptionType\Entity\SubscriptionType",
     *     inversedBy="subscriptionCountryFees")
     */
    private SubscriptionType $subscriptionType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\EnabledCountry\Entity\EnabledCountry",
     *     inversedBy="subscriptionCountryFees")
     */
    private EnabledCountry $enabledCountry;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return SubscriptionCountryFees
     */
    public function setCurrency(string $currency): SubscriptionCountryFees
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return float
     */
    public function getFees(): float
    {
        return $this->fees;
    }

    /**
     * @param float $fees
     * @return SubscriptionCountryFees
     */
    public function setFees(float $fees): SubscriptionCountryFees
    {
        $this->fees = $fees;
        return $this;
    }

    /**
     * @return SubscriptionType
     */
    public function getSubscriptionType(): SubscriptionType
    {
        return $this->subscriptionType;
    }


    public function setSubscriptionType(SubscriptionType $subscriptionType):self
    {
        $this->subscriptionType = $subscriptionType;
        return $this;
    }

    /**
     * @return EnabledCountry
     */
    public function getEnabledCountry(): EnabledCountry
    {
        return $this->enabledCountry;
    }

    /**
     * @param EnabledCountry $enabledCountry
     * @return SubscriptionCountryFees
     */
    public function setEnabledCountries(EnabledCountry $enabledCountry): self
    {
        $this->enabledCountry = $enabledCountry;
        return $this;
    }

}