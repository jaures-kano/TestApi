<?php


namespace App\Domain\Auth\Traits;


use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class SystemsInformations
 * @package App\Domain\Auth\Traits
 * @author jaures kano <ruddyjaures@mail.com>
 */
trait SystemsInformations
{

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $resetTime;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $resetCode = null;

    /**
     * @return DateTimeInterface|null
     */
    public function getResetTime(): ?DateTimeInterface
    {
        return $this->resetTime;
    }

    public function setResetTime(?DateTimeInterface $resetTime): self
    {
        $this->resetTime = $resetTime;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getResetCode(): ?float
    {
        return $this->resetCode;
    }

    public function setResetCode(?float $resetCode): self
    {
        $this->resetCode = $resetCode;
        return $this;
    }


}