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


    public function successResponse(array $data, $status = 200): CaseResponse
    {
        return new CaseResponse(true, $data, $status);
    }

    public function errorResponse(array $data, $status = 400): CaseResponse
    {
        return new CaseResponse(false, $data, $status);
    }

    public function em()
    {
        return $this->getDoctrine()->getManager();
    }
}