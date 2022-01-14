<?php


namespace App\Domain\Trader\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Trader\Entity
 * @ORM\Entity()
 */
class Trader
{
    use BaseTimeTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private ?Ulid $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\AuthDomain\Auth\Entity\User", inversedBy="trader")
     */
    private User $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isEnabled = false;

    /**
     * @return ?Ulid
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Trader
     */
    public function setUser(User $user): Trader
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     * @return self
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

}