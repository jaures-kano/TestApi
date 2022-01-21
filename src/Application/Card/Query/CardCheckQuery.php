<?php

namespace App\Application\Card\Query;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;

/**
 * Class CardCheckQuery
 * @package App\Application\Card\Query
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CardCheckQuery extends AbstractCase
{

    public function checkCard(string $accessToken, string $apiKey, string $cardNumber): CaseResponse
    {


        return $this->successResponse([], HttpStatus::ACCEPTED);
    }
}