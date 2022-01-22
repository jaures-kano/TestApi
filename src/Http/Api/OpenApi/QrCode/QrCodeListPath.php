<?php

namespace App\Http\Api\OpenApi\QrCode;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\Parameter;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class QrCodeListPath
 * @package App\Http\Api\OpenApi\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class QrCodeListPath
{
    public function listQrCodePath($tag, $operationId = 'default'): PathItem
    {
        return new PathItem(
            null, null, null,
            new Operation(
                $operationId,
                [$tag],
                [
                    Response::HTTP_OK => [
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'token' => [
                                            'type' => 'string',
                                            'example' => '000',
                                        ],
                                        'refresh_token' => [
                                            'type' => 'string',
                                            'example' => '00',
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Refresh user token when is expired',
                '', null,
                [
                    new Parameter('card_id', 'query', 'Card id'),
                    new Parameter('access_token', 'query', 'Qr code string'),
                    new Parameter('api_key', 'query', 'Api key')
                ]
                , null, null,
            ));
    }

}