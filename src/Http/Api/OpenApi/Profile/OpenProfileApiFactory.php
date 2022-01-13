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

    /**
     * @param OpenApiFactoryInterface $decorated
     * @param InformationProfilePath $informationProfilePath
     */
    public function __construct(OpenApiFactoryInterface $decorated,
                                InformationProfilePath  $informationProfilePath)
    {
        $this->decorated = $decorated;
        $this->informationProfilePath = $informationProfilePath;
    }


    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/profile/information',
            $this->informationProfilePath->addInformationProfile(
                'Profile information', 'profile-information'));


        return $openApi;
    }
}