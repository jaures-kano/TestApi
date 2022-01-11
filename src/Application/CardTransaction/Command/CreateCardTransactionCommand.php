<?php


namespace App\Application\CardTransaction\Command;


use App\Application\CardTransaction\Dto\CardTransactionDto;
use App\Domain\CardsDomain\CardTransaction\Entity\CardTransaction;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\CardTransaction\Command
 */
class CreateCardTransactionCommand
{
    public function create(CardTransactionDto $cardTransactionDto, EntityManagerInterface $manager)
    {
        $cardTransaction = new CardTransaction();

        $cardTransaction->setUser($cardTransactionDto->user)
            ->setAmount($cardTransactionDto->amount)
            ->setType($cardTransactionDto->type)
            ->setCard($cardTransactionDto->card)
            ->setFees($cardTransactionDto->fees)
            ->setRecipient($cardTransactionDto->recipient)
            ->setReferenceNumber($cardTransactionDto->referenceNumber)
            ->setTransmitter($cardTransactionDto->transmitter)
            ->setCreatedAt($cardTransactionDto->createdAt)
            ->setUpdatedAt($cardTransactionDto->updatedAt)
        ;
    }
}