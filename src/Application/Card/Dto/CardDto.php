<?php


namespace App\Application\Card\Dto;


use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\CardsDomain\Card\Entity\Card;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Card\Dto
 */
class CardDto
{
    public ?int $cardNumber;
    public ?float $balance;
    public ?DateTimeInterface $expiredAt;
    public ?User $user;
    public ?Collection $cardTransaction;
    public ?DateTimeInterface $createdAt;
    public ?DateTimeInterface $updatedAt;

    public function construct (?Card $card = null)
    {
        $this->cardNumber = $card === null ? null : $card->getCardNumber();
        $this->balance = $card === null ? null : $card->getBalance();
        $this->expiredAt = $card === null ? null : $card->getExpiredAt();
        $this->user = $card === null ? null : $card->getUser();
        $this->cardTransaction = $card === null ? null : $card->getCardTransaction();
        $this->createdAt = $card === null ? null : $card->getCreatedAt();
        $this->updatedAt = $card === null ? null : $card->getUpdatedAt();
    }
}