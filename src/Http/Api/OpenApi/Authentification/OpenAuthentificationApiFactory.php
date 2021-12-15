<?php

namespace App\Http\Api\OpenApi\Authentification;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

/**
 * Class OpenAuthentificationApiFactory
 * @package App\Http\Api\OpenApi\Authentification
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenAuthentificationApiFactory implements OpenApiFactoryInterface
{

    private OpenApiFactoryInterface $decorated;
    private AuthentificationLoginPath $authentificationLoginPath;

    /**
     * @param OpenApiFactoryInterface $decorated
     * @param AuthentificationLoginPath $authentificationLoginPath
     */
    public function __construct(OpenApiFactoryInterface   $decorated,
                                AuthentificationLoginPath $authentificationLoginPath)
    {
        $this->decorated = $decorated;
        $this->authentificationLoginPath = $authentificationLoginPath;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/login',
            $this->authentificationLoginPath->addLoginPath(
                'Authentification proccess', 'auth-login'));

        return $openApi;
    }
}