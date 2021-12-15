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

    /**
     * @param OpenApiFactoryInterface $decorated
     * @param PasswordRecoverPath $passwordRecoverPath
     * @param ResetPasswordPath $resetPasswordPath
     * @param RefreshTokenPath $refreshTokenPath
     * @param AuthentificationLoginPath $authentificationLoginPath
     */
    public function __construct(OpenApiFactoryInterface   $decorated,
                                PasswordRecoverPath       $passwordRecoverPath,
                                ResetPasswordPath         $resetPasswordPath,
                                RefreshTokenPath          $refreshTokenPath,
                                AuthentificationLoginPath $authentificationLoginPath)
    {
        $this->decorated = $decorated;
        $this->authentificationLoginPath = $authentificationLoginPath;
        $this->passwordRecoverPath = $passwordRecoverPath;
        $this->resetPasswordPath = $resetPasswordPath;
        $this->refreshTokenPath = $refreshTokenPath;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/auth/login',
            $this->authentificationLoginPath->addLoginPath(
                'Authentification proccess', 'auth-login'));
        $openApi->getPaths()->addPath('/api/auth/account/recover',
            $this->passwordRecoverPath->addPasswordRecoverPath(
                'Authentification proccess', 'recover-login'));
        $openApi->getPaths()->addPath('/api/auth/account/reset',
            $this->resetPasswordPath->addResetPasswordPath(
                'Authentification proccess', 'reset-login'));
        $openApi->getPaths()->addPath('/api/auth/token/refresh',
            $this->refreshTokenPath->addRefreshPath(
                'Authentification proccess', 'refresh-token-login'));


        return $openApi;
    }
}