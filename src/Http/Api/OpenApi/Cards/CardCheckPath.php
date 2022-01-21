<?php

namespace App\Http\Api\OpenApi\Cards;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\Parameter;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CardCheckPath
 * @package App\Http\Api\OpenApi\Cards
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardCheckPath
{

    public function checkCard($tag, $operationId = 'default'): PathItem
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
                                        'card' => [
                                            'type' => 'string',
                                            'example' => [
                                                'cardNumber' => '00000000000',
                                                'cardId' => '200FFFFFF',
                                                'cardOwner' => 'SHAKA ZULU'
                                            ],
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'check if card is in paiecash',
                '', null,
                [
                    new Parameter('card_number', 'query', 'Access token'),
                    new Parameter('user_mail', 'query', 'Access token'),
                    new Parameter('access_token', 'query', 'Access token'),
                    new Parameter('api_key', 'query', 'Api key')
                ]
            ), null, null,
        );
    }

}