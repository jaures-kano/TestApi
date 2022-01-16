<?php

namespace App\Domain\QrCodeDomain\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * Class QrCodeAffiliation
 * @package App\Domain\QrCodeDomain\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity(repositoryClass="App\Domain\QrCodeDomain\Repository\QrCodeAffiliationRepository")
 */
class QrCodeAffiliation
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
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private bool $isEnabled;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise",
     *     inversedBy="qrCodes")
     * @ORM\JoinColumn(nullable=false)
     */
    private Entreprise $entreprise;

    public function getId(): ?Ulid
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

    public function getEntreprise(): Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;
        return $this;
    }


}