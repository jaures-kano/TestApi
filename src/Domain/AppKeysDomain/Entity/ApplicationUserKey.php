<?php

namespace App\Domain\AppKeysDomain\Entity;


use App\Application\Traits\BaseTimeTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * Class ApplicationUserKey
 * @package App\Domain\AppKeysDomain\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity
 */
class ApplicationUserKey
{
    use BaseTimeTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private ?Ulid $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private string $key;

    /**
     * @ORM\Column(type="integer")
     */
    private int $keyAuthority = 1;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isValid = false;

    /**
     * @return Ulid|null
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return ApplicationUserKey
     */
    public function setKey(string $key): ApplicationUserKey
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return int
     */
    public function getKeyAuthority(): int
    {
        return $this->keyAuthority;
    }

    /**
     * @param int $keyAuthority
     * @return ApplicationUserKey
     */
    public function setKeyAuthority(int $keyAuthority): ApplicationUserKey
    {
        $this->keyAuthority = $keyAuthority;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     * @return ApplicationUserKey
     */
    public function setIsValid(bool $isValid): ApplicationUserKey
    {
        $this->isValid = $isValid;
        return $this;
    }

}