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
    private RefreshTokenPath $refreshTokenPath;
    private RegistrationPath $registrationPath;
    private RegistrationActivationPath $registrationActivationPath;
    private RegistrationSocialPath $registrationSocialPath;
    private AuthentificationSocialLoginPath $authentificationSocialLoginPath;


    public function __construct(OpenApiFactoryInterface         $decorated,
                                RegistrationPath                $registrationPath,
                                RefreshTokenPath                $refreshTokenPath,
                                RegistrationSocialPath          $registrationSocialPath,
                                AuthentificationSocialLoginPath $authentificationSocialLoginPath,
                                RegistrationActivationPath      $registrationActivationPath,
                                AuthentificationLoginPath       $authentificationLoginPath)
    {
        $this->decorated = $decorated;
        $this->registrationPath = $registrationPath;
        $this->authentificationLoginPath = $authentificationLoginPath;
        $this->refreshTokenPath = $refreshTokenPath;
        $this->registrationActivationPath = $registrationActivationPath;
        $this->registrationSocialPath = $registrationSocialPath;
        $this->authentificationSocialLoginPath = $authentificationSocialLoginPath;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/authentification/registration',
            $this->registrationPath->addRegistrationPath(
                'Authentification proccess', 'auth-registration'));

        $openApi->getPaths()->addPath('/api/authentification/registration/social/{Service}',
            $this->registrationSocialPath->addRegistrationPath(
                'Authentification proccess', 'auth-registration-social'));

        $openApi->getPaths()->addPath('/api/authentification/login',
            $this->authentificationLoginPath->addLoginPath(
                'Authentification proccess', 'auth-login'));

        $openApi->getPaths()->addPath('/api/authentification/login/social/{service}',
            $this->authentificationSocialLoginPath->addLoginPath(
                'Authentification proccess', 'auth-login-social'));

        $openApi->getPaths()->addPath('/api/authentification/token/refresh',
            $this->refreshTokenPath->addRefreshPath(
                'Authentification proccess', 'refresh-token-login'));

        $openApi->getPaths()->addPath('/api/authentification/registration/activation',
            $this->registrationActivationPath->activateRegistrationPath(
                'Authentification proccess', 'registration-activation-path'));

        return $openApi;
    }
}