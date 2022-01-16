<?php

namespace App\Http\Api\OpenApi\QrCode;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class QrCodeAddTransactionPath
 * @package App\Http\Api\OpenApi\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class QrCodeAddTransactionPath
{

    public function addQrCodePath($tag, $operationId = 'default'): PathItem
    {
        return new PathItem(
            null, null, null, null, null,
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
                                        'qrCode' => [
                                            'type' => 'string',
                                            'example' => 'PTR-000000000000000000000',
                                        ],
                                        'designation' => [
                                            'type' => 'string',
                                            'example' => 'mew new qr code',
                                        ],
                                        'message' => [
                                            'type' => 'string',
                                            'example' => '',
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Create a new qr code for transaction',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'designation' => [
                                        'type' => 'string',
                                        'example' => 'My new qr code',
                                        'required' => true
                                    ],
                                    'card_id' => [
                                        'type' => 'string',
                                        'example' => '00000000000000',
                                        'required' => true
                                    ],
                                    'entreprise_id' => [
                                        'type' => 'string',
                                        'example' => 'JNIDIDJNDJNDJNDJD',
                                        'required' => true
                                    ],
                                    'api_key' => [
                                        'type' => 'string',
                                        'example' => '000000000000000',
                                        'required' => true
                                    ],
                                    'access_token' => [
                                        'type' => 'string',
                                        'example' => '000000000000000',
                                        'required' => true
                                    ]
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }

}