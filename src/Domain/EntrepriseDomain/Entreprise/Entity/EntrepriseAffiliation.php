<?php


namespace App\Domain\EntrepriseDomain\Entreprise\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\EntrepriseDomain\Entreprise\Repository\EntrepriseAffiliationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\Entreprise\Entity
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
    private ?User $user = null;

    /**
     * @ORM\ManyToOne(targetEntity=EntrepriseInformation::class, inversedBy="entrepriseAffiliation")
     */
    private ?EntrepriseInformation $entreprise = null;

    /**
     * @return Ulid|null
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return EntrepriseAffiliation
     */
    public function setUser(?User $user): EntrepriseAffiliation
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return EntrepriseInformation|null
     */
    public function getEntreprise(): ?EntrepriseInformation
    {
        return $this->entreprise;
    }

    /**
     * @param EntrepriseInformation|null $entreprise
     * @return EntrepriseAffiliation
     */
    public function setEntreprise(?EntrepriseInformation $entreprise): EntrepriseAffiliation
    {
        $this->entreprise = $entreprise;

        return $this;
    }

}