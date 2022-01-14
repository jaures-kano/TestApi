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
    private PasswordRecoverPath $passwordRecoverPath;
    private ResetPasswordPath $resetPasswordPath;
    private RefreshTokenPath $refreshTokenPath;
    private RegistrationPath $registrationPath;
    private RegistrationActivationPath $registrationActivationPath;


    public function __construct(OpenApiFactoryInterface    $decorated,
                                RegistrationPath           $registrationPath,
                                PasswordRecoverPath        $passwordRecoverPath,
                                ResetPasswordPath          $resetPasswordPath,
                                RefreshTokenPath           $refreshTokenPath,
                                RegistrationActivationPath $registrationActivationPath,
                                AuthentificationLoginPath  $authentificationLoginPath)
    {
        $this->decorated = $decorated;
        $this->registrationPath = $registrationPath;
        $this->authentificationLoginPath = $authentificationLoginPath;
        $this->passwordRecoverPath = $passwordRecoverPath;
        $this->resetPasswordPath = $resetPasswordPath;
        $this->refreshTokenPath = $refreshTokenPath;
        $this->registrationActivationPath = $registrationActivationPath;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/authentification/registration',
            $this->registrationPath->addRegistrationPath(
                'Authentification proccess', 'auth-registration'));

        $openApi->getPaths()->addPath('/api/authentification/login',
            $this->authentificationLoginPath->addLoginPath(
                'Authentification proccess', 'auth-login'));

        $openApi->getPaths()->addPath('/api/authentification/account/recover',
            $this->passwordRecoverPath->addPasswordRecoverPath(
                'Authentification proccess', 'recover-login'));

        $openApi->getPaths()->addPath('/api/authentification/account/reset',
            $this->resetPasswordPath->addResetPasswordPath(
                'Authentification proccess', 'reset-login'));

        $openApi->getPaths()->addPath('/api/authentification/token/refresh',
            $this->refreshTokenPath->addRefreshPath(
                'Authentification proccess', 'refresh-token-login'));

        $openApi->getPaths()->addPath('/api/authentification/registration/activation',
            $this->registrationActivationPath->activateRegistrationPath(
                'Authentification proccess', 'registration-activation-path'));

        return $openApi;
    }
}