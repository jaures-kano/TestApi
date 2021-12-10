<?php

namespace App\Domain\Auth\Traits;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class UserLocationInformation
 * @package App\Domain\Auth\Traits
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


}