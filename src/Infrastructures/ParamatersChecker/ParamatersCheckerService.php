<?php

namespace App\Infrastructures\ParamatersChecker;


/**
 * Class ParamatersCheckerService
 * @package App\Infrastructures\ParamatersCheckerService
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ParamatersCheckerService
{

    public function arrayCheck(array $sendArray, array $arrayRequire): array
    {
        $missingData = [];

        $arrayKey = array_keys($sendArray);
        foreach ($arrayRequire as $item) {
            if (in_array($item, $arrayKey, true) === false) {
                $missingData[] = $item;
            }
        }

        return [
            'missing' => $missingData,
            'count' => count($missingData)
        ];
    }
}