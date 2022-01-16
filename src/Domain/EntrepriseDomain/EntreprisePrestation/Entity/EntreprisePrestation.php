<?php


namespace App\Domain\EntrepriseDomain\EntreprisePrestation\Entity;

use App\Application\Traits\BaseTimeTrait;
use App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise;
use App\Domain\EntrepriseDomain\EntreprisePrestation\Repository\EntreprisePrestationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntreprisePrestation\Entity
 * @ORM\Entity(repositoryClass=EntreprisePrestationRepository::class)
 */
class EntreprisePrestation
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
    private ?string $type = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $designation = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $imageName = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $price = null;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="products")
     */
    private Entreprise $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=EntreprisePromotion::class, inversedBy="product")
     */
    private EntreprisePromotion $promotion;

    /**
     * @return Ulid|null
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return EntreprisePrestation
     */
    public function setType(?string $type): EntreprisePrestation
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    /**
     * @param string|null $designation
     * @return EntreprisePrestation
     */
    public function setDesignation(?string $designation): EntreprisePrestation
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     * @return EntreprisePrestation
     */
    public function setImageName(?string $imageName): EntreprisePrestation
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     * @return EntreprisePrestation
     */
    public function setOrice(?int $price): EntreprisePrestation
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Entreprise
     */
    public function getEntreprise(): Entreprise
    {
        return $this->entreprise;
    }

    /**
     * @param Entreprise $entreprise
     * @return EntreprisePrestation
     */
    public function setEntreprise(Entreprise $entreprise): EntreprisePrestation
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return EntreprisePromotion
     */
    public function getPromotion(): EntreprisePromotion
    {
        return $this->promotion;
    }

    /**
     * @param EntreprisePromotion $promotion
     * @return EntreprisePrestation
     */
    public function setPromotion(EntreprisePromotion $promotion): EntreprisePrestation
    {
        $this->promotion = $promotion;

        return $this;
    }

}