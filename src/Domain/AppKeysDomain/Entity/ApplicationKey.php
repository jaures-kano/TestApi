<?php

namespace App\Domain\AppKeysDomain\Entity;


use App\Application\Traits\BaseTimeTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * Class ApplicationKey
 * @package App\Domain\AppKeysDomain\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity(repositoryClass="App\Domain\AppKeysDomain\Repository\ApplicationKeyRepository")
 */
class ApplicationKey
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
     * @ORM\Column(type="string")
     */
    private string $designation;

    /**
     * @ORM\Column(type="string")
     */
    private string $keyToken;

    /**
     * @ORM\Column(type="integer")
     */
    private int $keyTokenAuthority = 1;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isValid = false;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getDesignation(): string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): ApplicationKey
    {
        $this->designation = $designation;
        return $this;
    }

    public function getKeyToken(): string
    {
        return $this->keyToken;
    }

    public function setKeyToken(string $key): self
    {
        $this->keyToken = $key;
        return $this;
    }

    public function getKeyTokenAuthority(): int
    {
        return $this->keyTokenAuthority;
    }

    public function setKeyTokenAuthority(int $keyAuthority): self
    {
        $this->keyTokenAuthority = $keyAuthority;
        return $this;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;
        return $this;
    }

}