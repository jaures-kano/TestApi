<?php

namespace App\Domain\ProfileDomain\Entity;


use App\Domain\AuthDomain\Auth\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserRecovryRequest
 * @package App\Domain\ProfileDomain\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity(repositoryClass="App\Domain\ProfileDomain\Repository\UserRecoveryRequestRepository")
 */
class UserRecoveryRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $confirmationToken;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isValidate = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $requestAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $expiredAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $validateAt;

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

    public function isValidate(): bool
    {
        return $this->isValidate;
    }

    public function setIsValidate(bool $isValidate): UserRecoveryRequest
    {
        $this->isValidate = $isValidate;
        return $this;
    }


    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): UserRecoveryRequest
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }

    public function getRequestAt(): ?DateTimeInterface
    {
        return $this->requestAt;
    }

    public function setRequestAt(?DateTimeInterface $requestAt): UserRecoveryRequest
    {
        $this->requestAt = $requestAt;
        return $this;
    }

    public function getExpiredAt(): ?DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?DateTimeInterface $expiredAt): UserRecoveryRequest
    {
        $this->expiredAt = $expiredAt;
        return $this;
    }

    public function getValidateAt(): ?DateTimeInterface
    {
        return $this->validateAt;
    }

    public function setValidateAt(?DateTimeInterface $validateAt): UserRecoveryRequest
    {
        $this->validateAt = $validateAt;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): UserRecoveryRequest
    {
        $this->user = $user;
        return $this;
    }

}