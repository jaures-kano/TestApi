<?php


namespace App\Domain\EntrepriseDomain\EntreprisePrestation\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\EntrepriseDomain\EntreprisePrestation\Repository\EntreprisePromotionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\EntrepriseDomain\EntreprisePrestation\EntreprisePrestation\Entity
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
     * @ORM\OneToMany(targetEntity=EntreprisePrestation::class, mappedBy="promotion")
     */
    private ?Collection $prestation;


    public function __construct()
    {
        $this->prestation = new ArrayCollection();
    }

    /**
     * @return Ulid|null
     */
    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getVisibility(): ?DateTimeInterface
    {
        return $this->visibility;
    }

    public function setVisibility(?DateTimeInterface $visibility): EntreprisePromotion
    {
        $this->visibility = $visibility;

        return $this;
    }


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
    public function getPrestation()
    {
        return $this->prestation;
    }

}