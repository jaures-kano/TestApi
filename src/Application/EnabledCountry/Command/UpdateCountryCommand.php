<?php


namespace App\Application\EnabledCountry\Command;

use App\Adapter\Response\CaseResponse;
use App\Application\EnabledCountry\Dto\EnabledCountryDto;
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

    public function updateEnableCountrie(EnabledCountryDto $enabledCountryDto) : caseResponse
    {

    }
}