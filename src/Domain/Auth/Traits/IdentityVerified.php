<?php


namespace App\Domain\Auth\Traits;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class IdentityVerified
 * @package App\Domain\Auth\Traits
 * @author jaures kano <ruddyjaures@mail.com>
 */
trait IdentityVerified
{

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     * @Groups({"read:user"})
     */
    private bool $identityVerified = false;

    /**
     * @return bool
     */
    public function getIdentityVerified(): bool
    {
        return $this->identityVerified;
    }

    /**
     * @param bool $identityVerified
     * @return IdentityVerified
     */
    public function setIdentityVerified(bool $identityVerified): self
    {
        $this->identityVerified = $identityVerified;
        return $this;
    }


}