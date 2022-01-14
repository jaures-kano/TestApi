<?php

namespace App\Domain\CardsDomain\CardTransaction\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\CardsDomain\Card\Entity\Card;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;


/**
 * @ORM\Entity
 */
class CardTransaction
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
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $referenceNumber ;

    /**
     *  @var string
     * @ORM\Column(type="string")
     */
    private string $type;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private float $amount;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private float $fees;

    /**
     * @var string #
     * @ORM\Column(type="string")
     */
    private string $transmitter;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $recipient;

    /**
     * @ORM\ManyToOne (targetEntity="App\Domain\AuthDomain\Auth\Entity\User",
     *     inversedBy="cardTransactions")
     */
    private User $user;

    /**
     * @ORM\ManyToOne (targetEntity="App\Domain\CardsDomain\Card\Entity\Card",
     *     inversedBy="cardTransactions")
     */
    private Card $card;

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     * @return CardTransaction
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): CardTransaction
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Ulid
     */
    public function getId(): Ulid
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CardTransaction
     */
    public function setId(int $id): CardTransaction
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getReferenceNumber(): int
    {
        return $this->referenceNumber;
    }

    /**
     * @param int $referenceNumber
     * @return CardTransaction
     */
    public function setReferenceNumber(int $referenceNumber): CardTransaction
    {
        $this->referenceNumber = $referenceNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CardTransaction
     */
    public function setType(string $type): CardTransaction
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return CardTransaction
     */
    public function setAmount(float $amount): CardTransaction
    {
        $this->amount = $amount;
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
     * @return CardTransaction
     */
    public function setFees(float $fees): CardTransaction
    {
        $this->fees = $fees;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransmitter(): string
    {
        return $this->transmitter;
    }

    /**
     * @param string $transmitter
     * @return CardTransaction
     */
    public function setTransmitter(string $transmitter): CardTransaction
    {
        $this->transmitter = $transmitter;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     * @return CardTransaction
     */
    public function setRecipient(string $recipient): CardTransaction
    {
        $this->recipient = $recipient;
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
     * @return CardTransaction
     */
    public function setCreatedAt(DateTimeInterface $createdAt): CardTransaction
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
     * @return CardTransaction
     */
    public function setUser(User $user): CardTransaction
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @param Card $card
     * @return CardTransaction
     */
    public function setCard(Card $card): CardTransaction
    {
        $this->card = $card;
        return $this;
    }

}