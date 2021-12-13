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

    public string $messages;

    public array $data;

    /**
     * CaseResponse constructor.
     * @param bool $type
     * @param string $messages
     * @param array $data
     */
    public function __construct(bool $type, string $messages, array $data)
    {
        $this->type = $type;
        $this->messages = $messages;
        $this->data = $data;
    }


}