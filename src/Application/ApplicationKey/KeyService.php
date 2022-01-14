<?php

namespace App\Application\ApplicationKey;


use App\Domain\AppKeysDomain\Repository\ApplicationKeyRepository;

/**
 * Class KeyService
 * @package App\Application\ApplicationKey
 * @author jaures kano <ruddyjaures@mail.com>
 */
class KeyService
{

    private ApplicationKeyRepository $applicationKeyRepository;

    public function __construct(ApplicationKeyRepository $applicationKeyRepository)
    {
        $this->applicationKeyRepository = $applicationKeyRepository;
    }

    public function isValidKey($string): bool
    {
        $position = strpos($string, '-');
        $id = substr($string, 0, $position);
        $key = substr($string, $position, strlen($string) - 1);

        return true;
    }

    public function getKey($string): ?string
    {
        $findKey = $this->applicationKeyRepository->findOneBy(['designation' => $string]);
        if ($findKey !== null) {
            return $findKey->getId() . '-' . $findKey->getKeyToken();
        }
        return null;
    }

}