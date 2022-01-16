<?php


namespace App\Adapter\Response;


/**
 * Class CaseResponse
 * @package App\Adapter\Response
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class CaseResponse
{

    public bool $type;

    public array $data;

    public int $status;

    public function __construct(bool $type, array $data, $status = 200)
    {
        $this->type = $type;
        $this->data = $data;
        $this->status = $status;
    }


}