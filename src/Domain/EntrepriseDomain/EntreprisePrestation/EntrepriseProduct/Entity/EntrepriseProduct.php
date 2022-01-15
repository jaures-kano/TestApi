<?php


namespace App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\EntrepriseDomain\Entreprise\Entity\EntrepriseInformation;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Repository\EntrepriseProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Entity
 * @ORM\Entity(repositoryClass=EntrepriseProductRepository::class)
 */
class EntrepriseProduct
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
     * @ORM\ManyToOne(targetEntity=EntrepriseInformation::class, inversedBy="products")
     */
    private EntrepriseInformation $entreprise;

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
     * @return EntrepriseProduct
     */
    public function setType(?string $type): EntrepriseProduct
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
     * @return EntrepriseProduct
     */
    public function setDesignation(?string $designation): EntrepriseProduct
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
     * @return EntrepriseProduct
     */
    public function setImageName(?string $imageName): EntrepriseProduct
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
     * @return EntrepriseProduct
     */
    public function setOrice(?int $price): EntrepriseProduct
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return EntrepriseInformation
     */
    public function getEntreprise(): EntrepriseInformation
    {
        return $this->entreprise;
    }

    /**
     * @param EntrepriseInformation $entreprise
     * @return EntrepriseProduct
     */
    public function setEntreprise(EntrepriseInformation $entreprise): EntrepriseProduct
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
     * @return EntrepriseProduct
     */
    public function setPromotion(EntreprisePromotion $promotion): EntrepriseProduct
    {
        $this->promotion = $promotion;

        return $this;
    }

}