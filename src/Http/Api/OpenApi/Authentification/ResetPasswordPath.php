<?php

namespace App\Http\Api\OpenApi\Authentification;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResetPasswordPath
 * @package App\Http\Api\OpenApi\Authentification
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ResetPasswordPath
{

    public function addResetPasswordPath($tag, $operationId = 'default'): PathItem
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
                                            'example' => 'password well reset',
                                        ]
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Request recover password by user',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'password' => [
                                        'type' => 'string',
                                        'example' => '@zulu@',
                                    ],
                                    'passwordConfirm' => [
                                        'type' => 'string',
                                        'example' => '@zulu@',
                                    ],
                                    'resetCode' => [
                                        'type' => 'int',
                                        'example' => '0000',
                                    ]
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }
}