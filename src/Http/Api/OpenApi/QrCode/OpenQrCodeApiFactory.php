<?php

namespace App\Http\Api\OpenApi\QrCode;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

/**
 * Class OpenQrCodeApiFactory
 * @package App\Http\Api\OpenApi\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenQrCodeApiFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;
    private QrCodeAddPath $qrCodeAddPath;
    private QrCodeCheckApiPath $qrCodeCheckApiPath;
    private QrCodeListPath $qrCodeListPath;


    public function __construct(OpenApiFactoryInterface $decorated,
                                QrCodeAddPath           $qrCodeAddPath,
                                QrCodeCheckApiPath      $qrCodeCheckApiPath,
                                QrCodeListPath          $qrCodeListPath)
    {
        $this->decorated = $decorated;
        $this->qrCodeAddPath = $qrCodeAddPath;
        $this->qrCodeCheckApiPath = $qrCodeCheckApiPath;
        $this->qrCodeListPath = $qrCodeListPath;
    }


    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/qr_code/add',
            $this->qrCodeAddPath->addQrCodePath(
                'Qr code systems', 'qr-code-add'));

        $openApi->getPaths()->addPath('/api/qr_code/list',
            $this->qrCodeListPath->listQrCodePath(
                'Qr code systems', 'qr-code-list'));

        $openApi->getPaths()->addPath('/api/qr_code/check',
            $this->qrCodeCheckApiPath->checkQrCodePath(
                'Qr code systems', 'qr-code-check'));

        return $openApi;
    }
}