<?php


namespace App\Application\EnabledCountry\Dto;

use App\Domain\EnabledCountry\Entity\EnabledCountry;
use DateTime;

/**
 * Class EnabledCountryDto
 * @package App\Application\EnabledCountry\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class EnabledCountryDto
{
    public ?string $name;
    public ?string $callingCode;
    public ?string $region;
    public ?string $subRegion;
    public ?array $translation;
    public ?string $regexCode;
    public ?bool $isEnable;
    public ?DateTime $createdAt;
    public ?DateTime $updatedAt;

    /**
     * EnabledCountryDto constructor.
     * @param EnabledCountry|null $enabledCountry
     */
    public function __construct(?EnabledCountry $enabledCountry = null)
    {
        $this->name = $enabledCountry === null ? null : $enabledCountry->getName();
        $this->callingCode = $enabledCountry === null ? null : $enabledCountry->getCallingCode();
        $this->region = $enabledCountry === null ? null : $enabledCountry->getRegion();
        $this->subRegion = $enabledCountry === null ? null : $enabledCountry->getSubRegion();
        $this->translation = $enabledCountry === null ? null : $enabledCountry->getTranslations();
        $this->regexCode = $enabledCountry === null ? null : $enabledCountry->getRegexCode();
        $this->isEnable = $enabledCountry === null ? null : $enabledCountry->getIsEnabled();
        $this->createdAt = $enabledCountry === null ? null : $enabledCountry->getCreatedAt();
        $this->updatedAt = $enabledCountry === null ? null : $enabledCountry->getUpdatedAt();
    }
}