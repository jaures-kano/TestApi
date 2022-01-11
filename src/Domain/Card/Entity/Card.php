<?php

namespace App\Domain\Card\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\Auth\Entity\User;
use App\Domain\CardTransaction\Entity\CardTransaction;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


class Card
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
    private int $cardNumber;

    /**
     * @var float
     *  @ORM\Column(type="float")
     */
    private float $balance;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $expiredAt;


    /**
     * @ORM\ManyToOne (targetEntity=User::class, inversedBy="cards")
     */
    private User $user;

    /**
     * @ORM\OneToMany(targetEntity=CardTransaction::class,mappedBy="card" )
     */
    private Collection $cardTransaction;


    public function __construct()
    {
        $this->cardTransaction = new ArrayCollection();
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
     * @return Card
     */
    public function setId(int $id): Card
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCardNumber(): int
    {
        return $this->cardNumber;
    }

    /**
     * @param int $cardNumber
     * @return Card
     */
    public function setCardNumber(int $cardNumber): Card
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     * @return Card
     */
    public function setBalance(float $balance): Card
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getExpiredAt(): ?DateTimeInterface
    {
        return $this->expiredAt;
    }

    /**
     * @param DateTimeInterface $expiredAt
     * @return Card
     */
    public function setExpirationAt(DateTimeInterface $expiredAt): Card
    {
        $this->expiredAt = $expiredAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return Card
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): Card
    {
        $this->updatedAt = $updatedAt;
        return $this;
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
     * @return Card
     */
    public function setCreatedAt(DateTimeInterface $createdAt): Card
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Card
     */
    public function setUser(User $user): Card
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getCardTransaction(): Collection
    {
        return $this->cardTransaction;
    }
}