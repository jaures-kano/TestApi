<?php

namespace App\Http\Api\OpenApi\Profile;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PasswordRecoverPath
 * @package App\Http\Api\OpenApi\Authentification
 * @author jaures kano <ruddyjaures@mail.com>
 */
class PasswordRecoverPath
{

    public function addPasswordRecoverPath($tag, $operationId = 'default'): PathItem
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
                                            'example' => 'Confirmation code send user',
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
                                    'email' => [
                                        'type' => 'string',
                                        'example' => 'admin@admin.com',
                                        'required' => true
                                    ],
                                    'api_key' => [
                                        'type' => 'string',
                                        'example' => '0000000000000000',
                                        'required' => true
                                    ],
                                    'confirmation_mode' => [
                                        'type' => 'bool',
                                        'example' => true,
                                        'required' => true
                                    ],
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }

}