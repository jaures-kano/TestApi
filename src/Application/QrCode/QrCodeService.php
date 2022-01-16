<?php

namespace App\Application\QrCode;


use App\Domain\CardsDomain\Entity\Card;
use App\Domain\EntrepriseDomain\Entreprise\Entity\Entreprise;
use App\Infrastructures\Generator\TokenGenerator;

/**
 * Class QrCodeService
 * @package App\Application\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class QrCodeService
{

    public function generateTransactionQrCode(Card $card): string
    {
        $generator = new TokenGenerator();
        return 'PTR-' . $card->getId() . strtoupper($generator->getApiToken(10));
    }

    public function generateAffiliationQrCode(Entreprise $entreprise): string
    {
        $generator = new TokenGenerator();
        return 'PAF-' . $entreprise->getId() . strtoupper($generator->getApiToken(10));
    }
}