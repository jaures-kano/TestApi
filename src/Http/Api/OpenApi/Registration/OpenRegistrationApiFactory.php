<?php /** @noinspection NullPointerExceptionInspection */

namespace App\Http\Api\OpenApi\Registration;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;


/**
 * Class OpenRegistrationApiFactory
 * @package App\Http\Api\OpenApi\Registration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenRegistrationApiFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;

    private FirstRegistrationPath $firstRegistrationPath;

    public function __construct(OpenApiFactoryInterface $decorated, FirstRegistrationPath $firstRegistrationPath)
    {
        $this->decorated = $decorated;
        $this->firstRegistrationPath = $firstRegistrationPath;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/registration', $this->firstRegistrationPath->addRegistrationPath());
        return $openApi;
    }
}