<?php

namespace App\Domain\AuthDomain\Auth\Traits;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class UserLocationInformation
 * @package App\Domain\AuthDomain\Traits
 * @author jaures kano <ruddyjaures@mail.com>
 */
trait UserLocationInformation
{

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read:user"})
     */
    private ?string $city = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $latitude = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $longitude = null;

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return self
     */
    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return self
     */
    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }


}