<?php

namespace App\Http\Api\OpenApi\Cards;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class QrCodeAddAffiliationPath
 * @package App\Http\Api\OpenApi\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardRequestPath
{

    public function cardRequest($tag, $operationId = 'default'): PathItem
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
                                        'card_number' => [
                                            'type' => 'string',
                                            'example' => '000000000000000000000',
                                        ],
                                        'card_type' => [
                                            'type' => 'string',
                                            'example' => '000000000000000000000',
                                        ],
                                        'amount' => [
                                            'type' => 'string',
                                            'example' => '1000 EURO',
                                        ],
                                        'cvv' => [
                                            'type' => 'string',
                                            'example' => '624',
                                        ],
                                        'password' => [
                                            'type' => 'string',
                                            'example' => '11111',
                                        ],
                                        'expiredAt' => [
                                            'type' => 'string',
                                            'example' => '000000000000000000000',
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Refresh user token when is expired',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'user_id' => [
                                        'type' => 'string',
                                        'example' => 'OPPEEMMOEMOMEJNUNUNU',
                                    ],
                                    'card_type' => [
                                        'type' => 'string',
                                        'example' => 'OPPEEMMOEMOMEJNUNUNU',
                                    ],
                                    'amount' => [
                                        'type' => 'float',
                                        'example' => '10',
                                    ],
                                    'paiement_method' => [
                                        'type' => 'string',
                                        'example' => 'OPPEEMMOEMOMEJNUNUNU',
                                    ],
                                    'api_key' => [
                                        'type' => 'string',
                                        'example' => 'OPPEEMMOEMOMEJNUNUNU',
                                        'required' => true
                                    ],
                                    'access_token' => [
                                        'type' => 'string',
                                        'example' => 'jjijijij205kjbhvjhvhj',
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