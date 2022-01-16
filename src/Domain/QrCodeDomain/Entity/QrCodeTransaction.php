<?php

namespace App\Domain\QrCodeDomain\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\CardsDomain\Entity\Card;
use App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;


/**
 * Class QrCodeDomain
 * @package App\Domain\QrCodeDomain\Entity
 * @author Catherine Mani<crescencegracemani@gmail.com>
 * @ORM\Entity()
 */
class QrCodeTransaction
{

    use BaseTimeTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private ?Ulid $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $designation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $qrCode;

    /**
     * @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $isEnabled;

    /**
     * @ORM\ManyToOne (targetEntity="App\Domain\AuthDomain\Auth\Entity\User",
     *     inversedBy="qrCodes")
     */
    private User $user;

    /**
     * @ORM\ManyToOne (targetEntity="App\Domain\CardsDomain\Entity\Card",
     *     inversedBy="qrCodes")
     */
    private Card $card;

    /**
     * @ORM\ManyToOne (targetEntity="App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise",
     *     inversedBy="qrCodes")
     */
    private ?Entreprise $entreprise;

    public function getId(): Ulid
    {
        return $this->id;
    }

    public function getDesignation(): string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;
        return $this;
    }

    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    public function setQrCode(string $qrCode): self
    {
        $this->qrCode = $qrCode;
        return $this;
    }

    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(Card $card): self
    {
        $this->card = $card;
        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;
        return $this;
    }


}