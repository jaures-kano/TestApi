<?php

namespace App\Application\Traits;


use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class BaseTimeTrait
 * @package App\Application\Traits
 * @author jaures kano <ruddyjaures@mail.com>
 */
trait BaseTimeTrait
{

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:user", "read:qr_code"})
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:user", "read:qr_code"})
     */
    private ?DateTimeInterface $updatedAt = null;

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}