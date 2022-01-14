<?php

namespace App\Infrastructures\Generator;


/**
 * Class TokenGenerator
 * @package App\Infrastructures\Generator
 * @author jaures kano <ruddyjaures@mail.com>
 */
class TokenGenerator
{

    public function getToken(): string
    {
        $innerStrong = true;
        do {
            $bytes = openssl_random_pseudo_bytes(32, $innerStrong);
            // $bytes needs to be verified as well
        } while (!$bytes || !$innerStrong);

        return bindec($bytes);
    }
}