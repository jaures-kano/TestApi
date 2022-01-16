<?php

namespace App\Http\Api\OpenApi\Cards;


use ApiPlatform\Core\OpenApi\Model;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CardListPath
 * @package App\Http\Api\OpenApi\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardListPath
{

    public function cardList($tag, $operationId = 'default'): PathItem
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
                                            'example' => 'eyxxxGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0NDI0MDM3NTgsImVtYWlsIjoid',
                                        ],
                                        'refresh_token' => [
                                            'type' => 'string',
                                            'example' => 'eyxxxGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0NDI0MDM3NTgsImVtYWlsIjoid',
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
                    new Model\Parameter('access_token', 'query', 'Access token'),
                    new Model\Parameter('api_key', 'query', 'Api key')
                ]
            ), null, null,
        );
    }

}