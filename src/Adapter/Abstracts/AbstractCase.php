<?php


namespace App\Adapter\Abstracts;


use App\Adapter\Response\CaseResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AbstractCase
 * @package App\Adapter\Abstracts
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class AbstractCase extends AbstractController
{


    public function successResponse(string $message, array $data, $status = 200): CaseResponse
    {
        return new CaseResponse(true, $message, $data, $status);
    }

    public function errorResponse(string $message, array $data, $status = 200): CaseResponse
    {
        return new CaseResponse(false, $message, $data, $status);
    }

    public function em()
    {
        return $this->getDoctrine()->getManager();
    }
}