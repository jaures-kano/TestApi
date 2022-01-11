<?php

namespace App\Domain\Subscription\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Application\Traits\BaseTimeTrait;
use App\Domain\Auth\Entity\User;
use App\Domain\SubscriptionType\Entity\SubscriptionType;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


class Subscription
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
    private int $numberOfMonth;


    /**
     * @ORM\OneToMany(targetEntity=Card::class,mappedBy="subscription" )
     */
    private Collection $subscriptionTypes;


    /**
     * @ORM\OneToMany(targetEntity=Card::class,mappedBy="subscription" )
     */
    private Collection $users;

    public function __construct()
    {
        $this->subscriptionTypes = new ArrayCollection();
        $this->users= new ArrayCollection();
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
     * @return Subscription
     */
    public function setId(int $id): Subscription
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfMonth(): int
    {
        return $this->numberOfMonth;
    }

    /**
     * @param int $numberOfMonth
     * @return Subscription
     */
    public function setNumberOfMonth(int $numberOfMonth): Subscription
    {
        $this->numberOfMonth = $numberOfMonth;
        return $this;
    }

    /**
     * @return Collection|SubscriptionType[]
     */
    public function getSubscriptionTypes(): Collection
    {
        return $this->subscriptionTypes;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

}