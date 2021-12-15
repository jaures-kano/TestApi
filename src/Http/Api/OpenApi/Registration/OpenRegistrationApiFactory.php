<?php /** @noinspection NullPointerExceptionInspection */

namespace App\Http\Api\OpenApi\Registration;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;
use ArrayObject;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class OpenRegistrationApiFactory
 * @package App\Http\Api\OpenApi\Registration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenRegistrationApiFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $pathItem = new PathItem(
            null, null, null, null, null,
            new Operation(
                'get',
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
                    'tag',
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


        $openApi->getPaths()->addPath('/registration', $pathItem);
        return $openApi;
    }
}