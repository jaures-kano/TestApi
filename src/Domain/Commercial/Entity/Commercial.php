<?php


namespace App\Domain\Commercial\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\Auth\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\Commercial\Repository\CommercialRepository;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Commercial\Entity
 * @ORM\Entity(repositoryClass=CommercialRepository::class)
 */
class Commercial
{
    use BaseTimeTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $code;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\Auth\Entity\User", inversedBy="commercial")
     */
    private User $user;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

}