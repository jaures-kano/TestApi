<?php 

namespace App\Domain\EnabledCountry\Entity;

use App\Application\Traits\BaseTimeTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EnabledCountry
 * @package App\Domain\EnabledCountry\Entity
 * @author Catherine Mani<crescencegracemani@gmail.com>
 * @ORM\Entity
 */
class EnabledCountry {

    use BaseTimeTrait;
   
    /**
     * @ORM\ID
     * @ORM\GeneratedValue
     *@ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string",length="255", nullable=false)
     */
    private string $name;


    /**
     * @ORM\Column(type="string",length="255",nullable=false)
     */
    private string $callingCode;

    /**
     * @ORM\Column(type="string",length="255",nullable=true)
     */
    private string $region;

     /**
     * @ORM\Column(type="string",length="255",nullable=true)
     */
    private string $subRegion;
    
    /**
     * @ORM\Column(type="json")
     */
    private array $translations = [];
    
    /**
     * @ORM\Column(type="string", length="255",nullable=false)
     */
    private string $regexCode;

    /**
     * @ORM\Column( type="boolean", options={"default":true})
     */
    private bool $isEnabled;

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getId(): ?int
    {
       return $this->id;
    }
    /**
    * Undocumented function
    *
    * @return string
    */
    public function getName(): string
    {
       return $this->name;
    }
    
    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
       $this->name = $name;
        return $this;
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getCallingCode(): ?string
    {
       return $this->callingCode;
    }

    /**
     * Undocumented function
     *
     * @param string $callingCode
     * @return self
     */
    public function setCallingCode(string $callingCode): self
    {
         $this->callingCode = $callingCode;
         return $this;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getRegion(): ?string
    {
       return $this->region;
    }
    
    /**
     * Undocumented function
     *
     * @param string $region
     * @return self
     */
     public function setRegion(string $region): self
    {
         $this->region = $region;
         return $this;
    }
    
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getSubRegion(): string
    {
       return $this->subRegion;
    }

     /**
      * Undocumented function
      *
      * @param string $subRegion
      * @return self
      */
     public function setSubRegion(string $subRegion): self
    {
         $this->subRegion = $subRegion;
         return $this;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getTranslations(): array
    {
       return $this->translations;
    }

    /**
     * Undocumented function
     *
     * @param array $translations
     * @return self
     */
    public function setTranslations(array $translations): self
    {
         $this->translations = $translations;
         return $this;
    }
      
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getRegexCode(): string
    {
       return $this->regexCode;
    }


    /**
     * Undocumented function
     *
     * @param string $regexCode
     * @return self
     */
      public function setRegexCode(string $regexCode): self
    {
         $this->regexCode = $regexCode;
         return $this;
    }

    /**
     * Undocumented function
     *
     * @return bool
     */
    public function getIsEnabled(): bool
    {
       return $this->isEnabled;
    }

    /**
     * Undocumented function
     *
     * @param bool $isEnabled
     * @return self
     */
      public function setIsEnabled(bool $isEnabled): self
    {
         $this->isEnabled = $isEnabled;
         return $this;
    }
}