<?php

namespace App\Adapter;


/**
 * Class HttpStatus
 * @package App\Adapter
 * @author jaures kano <ruddyjaures@mail.com>
 */
class HttpStatus
{
    public const OK = 200;
    public const CREATED = 201;
    public const ACCEPTED = 202;
    public const NOCONTENT = 204;
    public const RESETCONTENT = 205;
    public const SEEOTHER = 303;

    /** error status */
    public const BADREQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const PAYMENTREQUIRED = 402;
    public const FORBIDEN = 403;
    public const NOTFOUND = 404;
    public const METHODNOTALLOWED = 405;
    public const TIMEOUT = 408;
    public const TOMANYREQUEST = 429;
    public const UNSUPPORTEDMEDIATYPE = 415;

}