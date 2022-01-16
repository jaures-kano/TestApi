<?php

namespace App\Application\QrCode;


use App\Domain\CardsDomain\Entity\Card;
use App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise;

/**
 * Class QrCodeService
 * @package App\Application\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class QrCodeService
{

    public function generateTransactionQrCode(Card $card): string
    {
        return 'PTR-' . $card->getId() . bin2hex(random_int(100, 999));
    }

    public function generateAffiliationQrCode(Entreprise $entreprise): string
    {
        return 'PAF-' . $entreprise->getId() . bin2hex(random_int(100, 999));
    }
}