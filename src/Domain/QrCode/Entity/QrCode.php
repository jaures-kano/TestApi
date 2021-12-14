<?php

namespace App\Domain\QrCode\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\Auth\Entity\User;
use Doctrine\ORM\Mapping as ORM;



/**
 * Class QrCode
 * @package App\Domain\QrCode\Entity
 * @author Catherine Mani<crescencegracemani@gmail.com>
 * @ORM\Entity()
 */

class QrCode
{

    use BaseTimeTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
  private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
  private string $qrCode;

    /**
     * @ORM\Column( type="boolean", options={"default":true})
     */
  private bool $isEnabled;

    /**
     * @ORM\ManyToOne (targetEntity=User::class, inversedBy="user")
     */
  private User $user;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    /**
     * @param string $qrCode
     * @return QrCode
     */
    public function setQrCode(string $qrCode): self
    {
        $this->qrCode = $qrCode;
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
     * @return QrCode
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;
        return $this;
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
     * @return QrCode
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

}