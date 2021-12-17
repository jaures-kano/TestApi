<?php


namespace App\Application\EnabledCountry\Command;

use App\Adapter\Response\CaseResponse;
use App\Application\EnabledCountry\Dto\EnabledCountryDto;
use App\Domain\EnabledCountry\Entity\EnabledCountry;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UpdateCountryCommand
 * @package App\Application\EnabledCountry\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class UpdateCountryCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function updateEnableCountrie(EnabledCountryDto $enabledCountryDto, EnabledCountry $country): caseResponse
    {
        $enabledCountryDto->name !== $country->getName() ? $country->setName($enabledCountryDto->name) : null;
        $enabledCountryDto->callingCode !== $country->getCallingCode() ? $country->setCallingCode($enabledCountryDto->callingCode) : null;
        $enabledCountryDto->region !== $country->getRegion() ? $country->setName($enabledCountryDto->region) : null;
        $enabledCountryDto->subRegion !== $country->getSubRegion() ? $country->setSubRegion($enabledCountryDto->subRegion) : null;
        $enabledCountryDto->translation !== $country->getTranslations() ? $country->setTranslations($enabledCountryDto->translation) : null;
        $enabledCountryDto->regexCode !== $country->getRegexCode() ? $country->setName($enabledCountryDto->regexCode) : null;
        $enabledCountryDto->isEnable !== $country->getIsEnabled() ? $country->setIsEnabled($enabledCountryDto->isEnable) : null;
        $enabledCountryDto->updatedAt !== $country->getName() ? $country->setUpdatedAt(new DateTime('now')) : null;

        return new caseResponse(true, "", []);
    }
}