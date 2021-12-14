<?php


namespace App\Application\EnabledCountry\Command;

use App\Adapter\Response\CaseResponse;
use App\Application\EnabledCountry\Dto\EnabledCountryDto;
use App\Domain\EnabledCountry\Entity\EnabledCountry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DisableOrUnableCountryCommand
 * @package App\Application\EnabledCountry\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class DisableOrUnableCountryCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function DisableOrUnableCountry(EnabledCountryDto $countryDto, EnabledCountry $country): caseResponse
    {
        if ($countryDto->isEnable) {
            $country->setIsEnabled($countryDto->isEnable);
            $this->manager->flush();
            return new CaseResponse(true, "le pays a bien été desactivé", [$country]);
        }

        $country->setIsEnabled($countryDto->isEnable);
        $this->manager->flush();
        return new CaseResponse(true, "le pays a bien été activé", [$country]);

    }
}