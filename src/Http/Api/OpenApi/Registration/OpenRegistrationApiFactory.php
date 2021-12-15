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

    private CompeletRegistrationPath $completeRegistrationPath;

    public function __construct(OpenApiFactoryInterface  $decorated,
                                FirstRegistrationPath    $firstRegistrationPath,
                                CompeletRegistrationPath $completeRegistrationPath)
    {
        $this->decorated = $decorated;
        $this->firstRegistrationPath = $firstRegistrationPath;
        $this->completeRegistrationPath = $completeRegistrationPath;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/registration/first',
            $this->firstRegistrationPath->addRegistrationPath(
                'Registration proccess', 'registration-complete'));
        $openApi->getPaths()->addPath('/registration/complete/info',
            $this->completeRegistrationPath->addCompletRegistrationPath(
                'Registration proccess', 'registration-first'));
        return $openApi;
    }
}