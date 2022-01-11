<?php

namespace App\Http\Api\OpenApi\Registration;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FirstRegistrationPath
 * @package App\Http\Api\OpenApi\AuthRegistration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class FirstRegistrationPath
{

    public function addRegistrationPath($tag = 'tag', $operationId = 'default'): PathItem
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
                                            'example' => 'Message send to { choice methode } user',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Add first information of user who want to create an account.',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'phone' => [
                                        'type' => 'string',
                                        'example' => '699 999 999',
                                    ],
                                    'email' => [
                                        'type' => 'shaka@paiecash.com',
                                        'example' => 'shaka@paiecash.com',
                                    ],
                                    'country' => [
                                        'type' => 'integer',
                                        'example' => 1
                                    ],
                                    'confirmation' => [
                                        'type' => 'boolean',
                                        'example' => true
                                    ],
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }

}