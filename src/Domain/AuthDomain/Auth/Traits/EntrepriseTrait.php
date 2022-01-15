<?php


namespace App\Domain\AuthDomain\Auth\Traits;

use App\Domain\EntrepriseDomain\Entreprise\Entity\EntrepriseOwner;
use App\Domain\EntrepriseDomain\EntrepriseClient\Entity\EntrepriseAffiliation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\AuthDomain\Auth\Traits
 */
trait EntrepriseTrait
{
    /**
     * @ORM\OneToMany(targetEntity=EntrepriseOwner::class, mappedBy="user")
     */
   private ?Collection $entrepriseOwner = null;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseAffiliation::class, mappedBy="user")
     */
   private ?Collection $entrepriseAffiliation = null;

   public function __construct()
   {
       $this->entrepriseOwner = new ArrayCollection();
       $this->entrepriseAffiliation = new ArrayCollection();
   }

    /**
     * @return Collection|null
     */
    public function getEntrepriseOwner(): ?Collection
    {
        return $this->entrepriseOwner;
    }

    public function getEntrepriseAffiliation(): ?Collection
    {
        return $this->entrepriseAffiliation;
    }
}