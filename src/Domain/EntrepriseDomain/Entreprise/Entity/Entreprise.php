<?php

namespace App\Domain\EntrepriseDomain\Entreprise\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * Class Entreprise
 * @package App\Domain\EntrepriseDomain\Entreprise\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity
 */
class Entreprise
{

    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private ?Ulid $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $designation;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getDesignation(): string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

}