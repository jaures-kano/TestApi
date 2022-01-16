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
    private QrCodeAddTransactionPath $qrCodeAddPath;
    private QrCodeCheckApiPath $qrCodeCheckApiPath;
    private QrCodeListPath $qrCodeListPath;
    private QrCodeDetailsPath $qrCodeDetailsPath;
    private QrCodeAddAffiliationPath $qrCodeAddAffiliationPath;


    public function __construct(OpenApiFactoryInterface  $decorated,
                                QrCodeAddTransactionPath $qrCodeAddPath,
                                QrCodeAddAffiliationPath $qrCodeAddAffiliationPath,
                                QrCodeDetailsPath        $qrCodeDetailsPath,
                                QrCodeCheckApiPath       $qrCodeCheckApiPath,
                                QrCodeListPath           $qrCodeListPath)
    {
        $this->decorated = $decorated;
        $this->qrCodeAddPath = $qrCodeAddPath;
        $this->qrCodeCheckApiPath = $qrCodeCheckApiPath;
        $this->qrCodeListPath = $qrCodeListPath;
        $this->qrCodeDetailsPath = $qrCodeDetailsPath;
        $this->qrCodeAddAffiliationPath = $qrCodeAddAffiliationPath;
    }


    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/qr_code/transaction/add',
            $this->qrCodeAddPath->addQrCodePath(
                'Qr code systems', 'qr-code-add'));

        $openApi->getPaths()->addPath('/api/qr_code/affiliation/add',
            $this->qrCodeAddAffiliationPath->addQrCodePath(
                'Qr code systems', 'qr-code-add-affiliation'));

        $openApi->getPaths()->addPath('/api/qr_code/list/affilliation',
            $this->qrCodeListPath->listQrCodePath(
                'Qr code systems', 'qr-code-list'));

        $openApi->getPaths()->addPath('/api/qr_code/list/transaction',
            $this->qrCodeListPath->listQrCodePath(
                'Qr code systems', 'qr-code-list-transaction'));

        $openApi->getPaths()->addPath('/api/qr_code/check',
            $this->qrCodeCheckApiPath->checkQrCodePath(
                'Qr code systems', 'qr-code-check'));

        $openApi->getPaths()->addPath('/api/qr_code/information/{code}',
            $this->qrCodeDetailsPath->detailsQrCodePath(
                'Qr code systems', 'qr-code-details'));

        return $openApi;
    }
}