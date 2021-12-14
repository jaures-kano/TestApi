<?php

namespace App\Domain\Auth\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Application\Traits\BaseTimeTrait;
use App\Domain\Auth\Traits\AuthSystems;
use App\Domain\Auth\Traits\IdentityVerified;
use App\Domain\Auth\Traits\ProccessorInfo;
use App\Domain\Auth\Traits\SystemsInformations;
use App\Domain\Auth\Traits\UserLocationInformation;
use App\Domain\Auth\Traits\UserPersonnalInformation;
use App\Domain\QrCode\Entity\QrCode;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Collection;
use Serializable;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;
use App\Domain\EnabledCountry\Entity\EnabledCountry;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Domain\Auth\Repository\UserRepository")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, Serializable
{
    use AuthSystems;
    use IdentityVerified;
    use ProccessorInfo;
    use UserPersonnalInformation;
    use UserLocationInformation;
    use SystemsInformations;
    use BaseTimeTrait;


    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     * @Groups({"read:user"})
     */
    private ?Ulid $id = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read:user"})
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read:user"})
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\ManyToOne(targetEntity=EnabledCountry::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private string $enabledCountry;

    /**
     * @ORM\OneToMany(targetEntity=QrCode::class,mappedBy="qrCodes" )
     */
    private Collection $qrCodes;

    /**
     * @return Collection|User[]
     */
    public function getQrCodes(): Collection
    {
        return $this->qrCodes;
    }

    /**
     * @return string
     */
    public function getEnabledCountry(): string
    {
        return $this->enabledCountry;
    }

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        // guarantee every user at least has ROLE_USER
        $this->roles[] = 'ROLE_USER';

        return array_unique($this->roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized): void
    {
        [
            $this->id,
            $this->email,
            $this->password,
        ] = unserialize($serialized);
    }
}