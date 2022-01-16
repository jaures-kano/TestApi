<?php

namespace App\Http\Api\OpenApi\Cards;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CardTransfertPath
 * @package App\Http\Api\OpenApi\Cards
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardTransfertPath
{

    public function cardTransfert($tag, $operationId = 'default'): PathItem
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
                                        'message' => [
                                            'type' => 'string',
                                            'example' => 'Transfert sucessfully done',
                                        ],
                                        'reference' => [
                                            'type' => 'string',
                                            'example' => '00000001122325555',
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Transfert money to an account',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'card_sender_id' => [
                                        'type' => 'string',
                                        'example' => 'IMIDMIMDIMIMDIMD',
                                        'required' => true
                                    ],
                                    'card_receiver_id' => [
                                        'type' => 'string',
                                        'example' => 'IMIDMIMDIMIMDIMD',
                                        'required' => true
                                    ],
                                    'amount' => [
                                        'type' => 'string',
                                        'example' => 10000,
                                        'required' => true
                                    ],
                                    'card_user_password' => [
                                        'type' => 'string',
                                        'example' => '123456',
                                        'required' => true
                                    ],
                                    'access_token' => [
                                        'type' => 'string',
                                        'example' => 'INDIOIDDJNDKimoDMoID',
                                        'required' => true
                                    ],
                                    'api_key' => [
                                        'type' => 'string',
                                        'example' => 'KJNKJDJKNomiomdodmIMSOMOSMKmomos',
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