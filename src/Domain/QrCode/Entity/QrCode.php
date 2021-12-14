<?php

namespace App\Domain\QrCode\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\Auth\Entity\User;
use Doctrine\ORM\Mapping as ORM;



/**
 * Class QrCode
 * @package App\Domain\QrCode\Entity
 * @author Catherine Mani<crescencegracemani@gmail.com>
 * @ORM\Entity
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     */
    public function setQrCode(string $qrCode): void
    {
        $this->qrCode = $qrCode;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }






}