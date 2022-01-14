<?php

namespace App\Http\Api\OpenApi\Authentification;


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
class RegistrationPath
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
                                    'first_name' => [
                                        'type' => 'string',
                                        'example' => 'zulu',
                                    ],
                                    'last_name' => [
                                        'type' => 'string',
                                        'example' => 'shaka',
                                    ],
                                    'phone' => [
                                        'type' => 'string',
                                        'example' => '699 999 999',
                                    ],
                                    'email' => [
                                        'type' => 'string',
                                        'example' => 'shaka@paiecash.com',
                                    ],
                                    'country' => [
                                        'type' => 'integer',
                                        'example' => '0000000'
                                    ],
                                    'password' => [
                                        'type' => 'string',
                                        'example' => '123456',
                                    ],
                                    'confirm_password' => [
                                        'type' => 'string',
                                        'example' => '123456',
                                    ],
                                    'confirmation_mode' => [
                                        'type' => 'boolean',
                                        'example' => true
                                    ],
                                    'api_key' => [
                                        'type' => 'string',
                                        'example' => '00000000000000000'
                                    ]
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }

}