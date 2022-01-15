<?php


namespace App\Domain\EntrepriseDomain\EntrepriseClient\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntrepriseClient\Entity
 * @ORM\Entity(repositoryClass=EntrepriseAffiliationRepository::class)
 */
class EntrepriseAffiliation
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="entrepriseAffiliation")
     */
    private ?User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="entrepriseAffiliation")
     */
    private ?Entreprise $entreprise;


    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

}