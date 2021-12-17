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

    public function addCompletRegistrationPath($tag, $operationId = 'default'): PathItem
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
                                            'example' => 'success update',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'Complete user information after use first registration path',
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
                                        'example' => 'Shaka@admin.com',
                                    ],
                                    'firstName' => [
                                        'type' => 'string',
                                        'example' => 'Shaka',
                                    ],
                                    'lastName' => [
                                        'type' => 'string',
                                        'example' => 'Shaka',
                                    ],
                                    'birthday' => [
                                        'type' => 'date',
                                        'example' => '2020-08-01',
                                    ],
                                    'confirmPassword' => [
                                        'type' => 'string',
                                        'example' => 'Zulu',
                                    ],
                                    'password' => [
                                        'type' => 'string',
                                        'example' => 'Zulu',
                                    ],
                                    'code' => [
                                        'type' => 'string',
                                        'example' => '00225'
                                    ],
                                ],
                            ],
                        ],
                    ]))
            )
        );
    }

}