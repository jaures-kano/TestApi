<?php


namespace App\Domain\AuthDomain\Auth\Traits;


use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class AuthSystems
 * @package App\Domain\AuthDomain\Traits
 * @author jaures kano <ruddyjaures@mail.com>
 */
trait AuthSystems
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:user"})
     */
    private ?DateTimeInterface $phoneVerfiedAt = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:user"})
     */
    private ?DateTimeInterface $emailVerfiedAt = null;

    /**
     * @ORM\Column(type="datetime", options={"default": null}, nullable=true)
     * @Groups({"read:user"})
     */
    private ?DateTimeInterface $lastLoginAt = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $confirmationToken = null;

    /**
     * @return DateTimeInterface|null
     */
    public function getPhoneVerfiedAt(): ?DateTimeInterface
    {
        return $this->phoneVerfiedAt;
    }

    /**
     * @param DateTimeInterface|null $phonelVerfiedAt
     * @return self
     */
    public function setPhoneVerfiedAt(?DateTimeInterface $phonelVerfiedAt): self
    {
        $this->phoneVerfiedAt = $phonelVerfiedAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEmailVerfiedAt(): ?DateTimeInterface
    {
        return $this->emailVerfiedAt;
    }

    /**
     * @param DateTimeInterface|null $emailVerfiedAt
     * @return self
     */
    public function setEmailVerfiedAt(?DateTimeInterface $emailVerfiedAt): self
    {
        $this->emailVerfiedAt = $emailVerfiedAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getLastLoginAt(): ?DateTimeInterface
    {
        return $this->lastLoginAt;
    }

    /**
     * @param DateTimeInterface|null $lastLoginAt
     * @return self
     */
    public function setLastLoginAt(?DateTimeInterface $lastLoginAt): self
    {
        $this->lastLoginAt = $lastLoginAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    /**
     * @param string|null $confirmationToken
     * @return self
     */
    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }


}