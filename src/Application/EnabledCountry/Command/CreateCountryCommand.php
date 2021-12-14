<?php


namespace App\Application\EnabledCountry\Command;

use App\Adapter\Response\CaseResponse;
use App\Application\EnabledCountry\Dto\EnabledCountryDto;
use App\Domain\EnabledCountry\Entity\EnabledCountry;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CreateCountryCommand
 * @package App\Application\EnabledCountry\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class CreateCountryCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function addEnableCountrie(EnabledCountryDto $enabledCountryDto): CaseResponse
    {
        $country = new EnabledCountry();

        $country->setName($enabledCountryDto->name)
            ->setCallingCode($enabledCountryDto->callingCode)
            ->setRegion($enabledCountryDto->region)
            ->setSubRegion($enabledCountryDto->subRegion)
            ->setTranslations($enabledCountryDto->translation)
            ->setRegexCode($enabledCountryDto->regexCode)
            ->setIsEnabled($enabledCountryDto->isEnable)
            ->setCreatedAt(new DateTime('now'));
        $this->manager->persist($country);
        $this->manager->flush();

        return new caseResponse(true, "Le pays a bien été ajouter", [$country]);
    }
}