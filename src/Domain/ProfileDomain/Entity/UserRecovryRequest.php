<?php

namespace App\Domain\ProfileDomain\Entity;


use App\Domain\AuthDomain\Auth\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserRecovryRequest
 * @package App\Domain\ProfileDomain\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity
 */
class UserRecovryRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $confirmationToken;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $requestAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $expiredAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\AuthDomain\Auth\Entity\User",
     *     inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): UserRecovryRequest
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }

    public function getRequestAt(): ?DateTimeInterface
    {
        return $this->requestAt;
    }

    public function setRequestAt(?DateTimeInterface $requestAt): UserRecovryRequest
    {
        $this->requestAt = $requestAt;
        return $this;
    }

    public function getExpiredAt(): ?DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?DateTimeInterface $expiredAt): UserRecovryRequest
    {
        $this->expiredAt = $expiredAt;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): UserRecovryRequest
    {
        $this->user = $user;
        return $this;
    }

}