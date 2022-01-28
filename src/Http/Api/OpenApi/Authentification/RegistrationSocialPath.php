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
class RegistrationSocialPath
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
                                            'example' => 'Profile create',
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
                                    'email' => [
                                        'type' => 'string',
                                        'example' => 'shaka@paiecash.com',
                                    ],
                                    'account_id' => [
                                        'type' => 'string',
                                        'example' => '123450000000006',
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