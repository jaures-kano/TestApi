<?php


namespace App\Domain\AuthDomain\Auth\Traits;


use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class PersonnalUserInformations
 * @package App\Domain\AuthDomain\Traits
 * @author jaures kano <ruddyjaures@mail.com>
 */
trait UserPersonnalInformation
{
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read:user"})
     */
    private ?string $phone = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read:user"})
     */
    private ?string $firstName = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read:user"})
     */
    private ?string $lastName = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read:user"})
     */
    private ?string $cni = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read:user"})
     */
    private ?string $nui = null;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"read:user"})
     */
    private ?DateTimeInterface $birhday = null;

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(?string $cni): self
    {
        $this->cni = $cni;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNui(): ?string
    {
        return $this->nui;
    }

    public function setNui(?string $nui): self
    {
        $this->nui = $nui;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getBirhday(): ?DateTimeInterface
    {
        return $this->birhday;
    }

    public function setBirhday(?DateTimeInterface $birhday): self
    {
        $this->birhday = $birhday;
        return $this;
    }


}