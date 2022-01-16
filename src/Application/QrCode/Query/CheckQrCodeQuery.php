<?php

namespace App\Application\QrCode\Query;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;

/**
 * Class CheckQrCodeQuery
 * @package App\Application\QrCode\Query
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CheckQrCodeQuery extends AbstractCase
{

    public function check(string $code, string $apiKey): CaseResponse
    {

        return $this->successResponse('', [], HttpStatus::ACCEPTED);
    }

}