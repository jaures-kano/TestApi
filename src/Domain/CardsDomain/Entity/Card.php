<?php

namespace App\Domain\CardsDomain\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * Class Card
 * @package App\Domain\CardsDomain\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity
 */
class Card
{
    use BaseTimeTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private Ulid $id;

    /**
     * @ORM\Column(type="date", length=255)
     */
    private DateTimeInterface $expiredAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $cvv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $cardNumber;

    /**
     * @ORM\Column(type="float")
     */
    private float $amount = 0;

    /**
     * @ORM\ManyToOne (targetEntity="App\Domain\AuthDomain\Auth\Entity\User",
     *     inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise",
     *     inversedBy="cards")
     */
    private ?Entreprise $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\CardsDomain\Entity\CardType",
     *     inversedBy="cards")
     * @ORM\JoinColumn(nullable=false)
     */
    private CardType $cardType;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\QrCodeDomain\Entity\QrCodeTransaction",
     *     mappedBy="card")
     */
    private Collection $qrCodes;

    public function __construct()
    {
        $this->qrCodes = new ArrayCollection();
    }

    public function getId(): Ulid
    {
        return $this->id;
    }

    public function getExpiredAt(): DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(DateTimeInterface $expiredAt): Card
    {
        $this->expiredAt = $expiredAt;
        return $this;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): Card
    {
        $this->cvv = $cvv;
        return $this;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): Card
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(?User $user): Card
    {
        $this->user = $user;
        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): Card
    {
        $this->entreprise = $entreprise;
        return $this;
    }


    public function getCardType(): CardType
    {
        return $this->cardType;
    }

    public function setCardType(CardType $cardType): Card
    {
        $this->cardType = $cardType;
        return $this;
    }

    public function getQrCodes()
    {
        return $this->qrCodes;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }


}