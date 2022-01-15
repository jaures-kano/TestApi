<?php

namespace App\Http\Api\Controller\QrCode;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/qr_code")
 * Class QrCodeCheckController
 * @package App\Http\Api\Controller\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class QrCodeCheckController extends AbstractController
{


    /**
     * @Route("/check/{code}", name="api_qr_code_check")
     */
    public function qrcodeCheck(string $code)
    {


    }

}