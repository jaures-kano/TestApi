<?php


namespace App\Application\CardTransaction\Dto;


use App\Domain\Auth\Entity\User;
use App\Domain\Card\Entity\Card;
use App\Domain\CardTransaction\Entity\CardTransaction;
use DateTimeInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\CardTransaction\Dto
 */
class CardTransactionDto
{
    public ?int $referenceNumber;
    public ?string $type;
    public ?float $amount;
    public ?float $fees;
    public ?string $transmitter;
    public ?string $recipient;
    public ?User $user;
    public ?Card $card;
    public ?DateTimeInterface $createdAt;
    public ?DateTimeInterface $updatedAt;

    public function __construct(?CardTransaction $cardTransaction = null)
    {
        $this->referenceNumber = $cardTransaction === null ? null : $cardTransaction->getReferenceNumber();
        $this->type = $cardTransaction === null ? null : $cardTransaction->getType();
        $this->amount = $cardTransaction === null ? null : $cardTransaction->getAmount();
        $this->fees = $cardTransaction === null ? null : $cardTransaction->getFees();
        $this->transmitter = $cardTransaction === null ? null : $cardTransaction->getTransmitter();
        $this->recipient = $cardTransaction === null ? null : $cardTransaction->getRecipient();
        $this->user = $cardTransaction === null ? null : $cardTransaction->getUser();
        $this->card = $cardTransaction === null ? null : $cardTransaction->getCard();
        $this->createdAt = $cardTransaction === null ? null : $cardTransaction->getCreatedAt();
        $this->updatedAt = $cardTransaction === null ? null : $cardTransaction->getUpdatedAt();
    }
}