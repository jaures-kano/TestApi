<?php


namespace App\Application\Card\Command;


use App\Application\Card\Dto\CardDto;
use App\Domain\Card\Entity\Card;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Card\Command
 */
class CreateCardCommand
{
    public function create(CardDto $cardDto, EntityManagerInterface $manager)
    {
        $card = new Card();

        $card->setBalance($cardDto->balance)
            ->setCardNumber($cardDto->cardNumber)
            ->setUser($cardDto->user)
            ->setExpirationAt($cardDto->expiredAt)
            ->setCreatedAt($cardDto->createdAt)
            ->setUpdatedAt($cardDto->updatedAt)
            ;

        $manager->persist($card);
        $manager->flush();
    }
}