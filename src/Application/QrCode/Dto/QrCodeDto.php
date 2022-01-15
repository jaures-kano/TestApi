<?php


namespace App\Application\QrCode\Dto;

/**
 * Class QrCodeDto
 * @package App\Application\QrCodeDomain\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class QrCodeDto
{
    public ?string $designation;

    public ?string $user;

    public function __construct($user, $designation)
    {
        $this->designation = $designation;
        $this->user = $user;
    }
}