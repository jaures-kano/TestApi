<?php


namespace App\Application\EnabledCountry\Query;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Domain\EnabledCountry\Repository\EnabledCountryRepository;

class EnabledCountryQuery extends AbstractCase
{

    private KeyService $keyService;
    private EnabledCountryRepository $enabledCountryRepository;

    public function __construct(KeyService               $keyService,
                                EnabledCountryRepository $enabledCountryRepository)
    {

        $this->keyService = $keyService;
        $this->enabledCountryRepository = $enabledCountryRepository;
    }

    public function getEnabledCoubtry($apiKey): CaseResponse
    {
        if ($this->keyService->isValidKey($apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }
        $counties = [];
        $allCountry = $this->enabledCountryRepository->findAll();
        foreach ($allCountry as $country) {
            $counties[] = [
                'id' => $country->getId(),
                'name' => $country->getName(),
                'calling_code' => $country->getCallingCode(),
                'regex_code' => $country->getRegexCode()
            ];
        }

        return $this->successResponse([
            'countries' => $counties
        ], HttpStatus::ACCEPTED);
    }
}