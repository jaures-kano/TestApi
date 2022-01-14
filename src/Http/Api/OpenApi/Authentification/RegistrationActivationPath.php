<?php

namespace App\Http\Api\OpenApi\Authentification;


use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationActivationPath
 * @package App\Http\Api\OpenApi\AuthRegistration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationActivationPath
{

    public function activateRegistrationPath($tag = 'tag', $operationId = 'default'): PathItem
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
                                            'example' => 'Account activated',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Activate an account that have a first registration.',
                '', null, [],
                new RequestBody(
                    $operationId,
                    new ArrayObject([
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'email' => [
                                        'type' => 'shaka@paiecash.com',
                                        'example' => 'shaka@paiecash.com',
                                    ],
                                    'code' => [
                                        'type' => 'integer',
                                        'example' => 1
                                    ],
                                    'api_key' => [
                                        'type' => 'string',
                                        'example' => '00000000000000'
                                    ],
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }

}