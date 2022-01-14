<?php


namespace App\Domain\AuthDomain\Auth\Traits;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class IdentityVerified
 * @package App\Domain\AuthDomain\Traits
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
     * @ORM\Column(type="boolean", options={"default": false})
     * @Groups({"read:user"})
     */
    private bool $isActived = false;

    public function getIdentityVerified(): bool
    {
        return $this->identityVerified;
    }

    public function setIdentityVerified(bool $identityVerified): self
    {
        $this->identityVerified = $identityVerified;
        return $this;
    }

    public function isActived(): bool
    {
        return $this->isActived;
    }

    public function setIsActived(bool $isActived): self
    {
        $this->isActived = $isActived;
        return $this;
    }

}