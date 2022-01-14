<?php

namespace App\Infrastructures\Generator;


/**
 * Class TokenGenerator
 * @package App\Infrastructures\Generator
 * @author jaures kano <ruddyjaures@mail.com>
 */
class TokenGenerator
{

    public function getAuthToken(): string
    {
        $innerStrong = true;
        do {
            $bytes = openssl_random_pseudo_bytes(2, $innerStrong);
            // $bytes needs to be verified as well
        } while (!$bytes || !$innerStrong);

        return hexdec(bin2hex($bytes));
    }

    public function getApiToken($length = 20): string
    {
        $innerStrong = true;
        do {
            $bytes = openssl_random_pseudo_bytes($length, $innerStrong);
            // $bytes needs to be verified as well
        } while (!$bytes || !$innerStrong);
        return bin2hex($bytes);
    }

}