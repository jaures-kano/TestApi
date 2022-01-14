<?php

namespace App\Http\Api\OpenApi\EnableCountry;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

/**
 * Class OpenEnableCountryApiFactory
 * @package App\Http\Api\OpenApi\EnableCountry
 * @author jaures kano <ruddyjaures@mail.com>
 */
class OpenEnableCountryApiFactory implements OpenApiFactoryInterface
{
    private OpenApiFactoryInterface $decorated;
    private AddEnablesCountryPath $addEnablesCountryPath;
    private UpdateEnableCountryPath $updateEnableCountryPath;
    private EnableCountryListPath $enableCountryListPath;
    private EnableOrDesableCountryPath $enableOrDesableCountryPath;


    public function __construct(OpenApiFactoryInterface    $decorated,
                                AddEnablesCountryPath      $addEnablesCountryPath,
                                EnableOrDesableCountryPath $enableOrDesableCountryPath,
                                UpdateEnableCountryPath    $updateEnableCountryPath,
                                EnableCountryListPath      $enableCountryListPath)
    {
        $this->decorated = $decorated;
        $this->addEnablesCountryPath = $addEnablesCountryPath;
        $this->updateEnableCountryPath = $updateEnableCountryPath;
        $this->enableCountryListPath = $enableCountryListPath;
        $this->enableOrDesableCountryPath = $enableOrDesableCountryPath;
    }


    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);

        $openApi->getPaths()->addPath('/api/enable-country',
            $this->enableCountryListPath->listEnableCountryPath(
                'Enable country', 'enable-country'));

        $openApi->getPaths()->addPath('/api/enable-country/add',
            $this->addEnablesCountryPath->addEnableCountryPath(
                'Enable country', 'enable-country-add'));

        $openApi->getPaths()->addPath('/api/enable-country/update/{id}',
            $this->updateEnableCountryPath->updateEnableCountryPath(
                'Enable country', 'enable-country-update'));

        $openApi->getPaths()->addPath('/api/enable-country/enable_or_desable/{id}',
            $this->enableOrDesableCountryPath->enableOrDesableCountryPath(
                'Enable country', 'enable-country-update'));

        return $openApi;
    }
}