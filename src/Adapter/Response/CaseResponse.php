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

    public int $status;

    /**
     * CaseResponse constructor.
     * @param bool $type
     * @param string $messages
     * @param array $data
     * @param int $status
     */
    public function __construct(bool $type, string $messages, array $data, $status = 200)
    {
        $this->type = $type;
        $this->messages = $messages;
        $this->data = $data;
        $this->status = $status;
    }


}