<?php

namespace App\Http\Api\OpenApi\Registration;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CompeletRegistrationInformationPath
 * @package App\Http\Api\OpenApi\Registration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CompeletRegistrationPath
{

    public function addCompletRegistrationPath($operationId = 'default'): PathItem
    {
        return new PathItem(
            null, null, null, null, null,
            new Operation(
                $operationId,
                ['Stats'],
                [
                    Response::HTTP_OK => [
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'books_count' => [
                                            'type' => 'integer',
                                            'example' => 997,
                                        ],
                                        'topbooks_count' => [
                                            'type' => 'integer',
                                            'example' => 101,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Retrieves the number of books and top books (legacy endpoint).',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'books_count' => [
                                        'type' => 'integer',
                                        'example' => 997,
                                    ],
                                    'topbooks_count' => [
                                        'type' => 'integer',
                                        'example' => 101,
                                    ],
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }

}