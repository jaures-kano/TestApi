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

    /**
     * @param OpenApiFactoryInterface $decorated
     * @param UpdateInformationProfilePath $updateInformationProfilePath
     * @param InformationProfilePath $informationProfilePath
     */
    public function __construct(OpenApiFactoryInterface      $decorated,
                                UpdateInformationProfilePath $updateInformationProfilePath,
                                InformationProfilePath       $informationProfilePath)
    {
        $this->decorated = $decorated;
        $this->informationProfilePath = $informationProfilePath;
        $this->updateInformationProfilePath = $updateInformationProfilePath;
    }


    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/profile/information',
            $this->informationProfilePath->addInformationProfile(
                'Profile information', 'profile-information'));

        $openApi->getPaths()->addPath('/api/profile/update',
            $this->updateInformationProfilePath->addUpdateInformationProfile(
                'Profile information', 'profile-update'));


        return $openApi;
    }
}