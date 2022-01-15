<?php

namespace App\Http\Api\OpenApi\Profile;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

/**
 * Class OpenProfileApiFactory
 * @package App\Http\Api\OpenApi\Profile
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenProfileApiFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;

    private InformationProfilePath $informationProfilePath;

    private UpdateInformationProfilePath $updateInformationProfilePath;
    private PasswordRecoverPath $passwordRecoverPath;
    private ResetPasswordPath $resetPasswordPath;


    public function __construct(OpenApiFactoryInterface      $decorated,
                                UpdateInformationProfilePath $updateInformationProfilePath,
                                PasswordRecoverPath          $passwordRecoverPath,
                                ResetPasswordPath            $resetPasswordPath,
                                InformationProfilePath       $informationProfilePath)
    {
        $this->decorated = $decorated;
        $this->informationProfilePath = $informationProfilePath;
        $this->updateInformationProfilePath = $updateInformationProfilePath;
        $this->passwordRecoverPath = $passwordRecoverPath;
        $this->resetPasswordPath = $resetPasswordPath;
    }


    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/profile/information',
            $this->informationProfilePath->addInformationProfile(
                'Profile', 'profile-information'));

        $openApi->getPaths()->addPath('/api/profile/update',
            $this->updateInformationProfilePath->addUpdateInformationProfile(
                'Profile', 'profile-update'));

        $openApi->getPaths()->addPath('/api/profile/account/recover',
            $this->passwordRecoverPath->addPasswordRecoverPath(
                'Profile', 'recover-login'));

        $openApi->getPaths()->addPath('/api/profile/account/reset',
            $this->resetPasswordPath->addResetPasswordPath(
                'Profile', 'reset-login'));


        return $openApi;
    }
}