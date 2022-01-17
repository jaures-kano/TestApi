<?php

namespace App\Http\Api\OpenApi\EnableCountry;


use ApiPlatform\Core\OpenApi\Model;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EnableCountryListPath
 * @package App\Http\Api\OpenApi\EnableCountry
 * @author jaures kano <ruddyjaures@mail.com>
 */
class EnableCountryListPath
{

    public function listEnableCountryPath($tag, $operationId = 'default'): PathItem
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
                                        'countries' => [
                                            'type' => 'array',
                                            'example' => [
                                                '...',
                                                [
                                                    'name' => 'cameroun',
                                                    'calling_code' => '+237',
                                                    'regex_code' => 'cameroun',
                                                    'id' => 'PLDDJNDJK000',
                                                ]
                                            ],
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Get list of enable country',
                '', null,
                [
                    new Model\Parameter('api_key', 'query', 'Api key')
                ]
            ), null, null,
        );
    }

}