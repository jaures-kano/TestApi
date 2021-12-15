<?php

namespace App\Http\Api\OpenApi\Authentification;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthentificationLoginPath
 * @package App\Http\Api\OpenApi\Authentification
 * @author jaures kano <ruddyjaures@mail.com>
 */
class AuthentificationLoginPath
{


    public function addLoginPath($tag = 'tag', $operationId = 'default'): PathItem
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
                                            'example' => 'successfull login!',
                                        ],
                                        'user' => [
                                            'type' => 'json',
                                            'example' => [
                                                'id' => '01FPWYHQ5V8Q8P4TH8ZHJYX4EX',
                                                'email' => 'admin@admin.com',
                                                'firstName' => 'shaka',
                                                'lastName' => 'zulu',
                                                'roles' => ['ROLE_USER'],
                                                'cni' => 'zulu',
                                                'nui' => '000022000220',
                                                'lastLoginAt' => '2021-12-14T17:06:25+00:00',
                                                'phoneVerfiedAt' => '2021-12-14T17:06:25+00:00',
                                                'emailVerfiedAt' => '2021-12-14T17:06:25+00:00',
                                                'createdAt' => '2021-12-14T17:06:25+00:00',
                                                'updatedAt' => '2021-12-14T17:06:25+00:00'
                                            ]
                                        ],
                                        'token' => [
                                            'type' => 'string',
                                            'example' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2Mzk1MzE4MTIsImV4cCI6MTYzOTUzNTQxMiwicm9sZXMiOlsiUk9MRV9VU0VSIl0'
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Log user with his credential.',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'username' => [
                                        'type' => 'string',
                                        'example' => 'shakazulu@zulu.com',
                                    ],
                                    'password' => [
                                        'type' => 'string',
                                        'example' => '@zulu@',
                                    ]
                                ],
                            ],
                        ],
                    ])
                )
            )
        );
    }
}