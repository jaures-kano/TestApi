<?php

namespace App\Domain\CardsDomain\Entity;


use App\Application\Traits\BaseTimeTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * Class CardTransaction
 * @package App\Domain\CardsDomain\Entity
 * @author jaures kano <ruddyjaures@mail.com>
 * @ORM\Entity
 */
class CardTransaction
{

    use BaseTimeTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private Ulid $id;

}