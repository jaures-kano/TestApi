<?php


namespace App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Entity;


use App\Application\Traits\BaseTimeTrait;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntreprisePrestation\EntrepriseProduct\Entity
 * @ORM\Entity(repositoryClass=EntreprisePromotionRepository::class)
 */
class EntreprisePromotion
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
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $visibility = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $percentage = null;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseProduct::class, mappedBy="promotion")
     */
    private ?Collection $product = null;

    /**
     * EntreprisePromotion constructor
     */
    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    /**
     * @return Ulid|null
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getVisibility(): ?DateTimeInterface
    {
        return $this->visibility;
    }

    /**
     * @param DateTimeInterface|null $visibility
     * @return EntreprisePromotion
     */
    public function setVisibility(?DateTimeInterface $visibility): EntreprisePromotion
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    /**
     * @param int|null $percentage
     * @return EntreprisePromotion
     */
    public function setPercentage(?int $percentage): EntreprisePromotion
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getProduct()
    {
        return $this->product;
    }

}