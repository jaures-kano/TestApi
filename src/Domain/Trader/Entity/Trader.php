<?php


namespace App\Domain\Trader\Entity;


use App\Application\Traits\BaseTimeTrait;
use App\Domain\Auth\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Trader\Entity
 * @ORM\Entity()
 */
class Trader
{
    use BaseTimeTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private Ulid $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::Class, inversedBy="trader")
     */
    private User $user;

}