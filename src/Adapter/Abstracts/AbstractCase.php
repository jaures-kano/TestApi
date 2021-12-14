<?php


namespace App\Adapter\Abstracts;


use App\Adapter\Response\CaseResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AbstractCase
 * @package App\Adapter\Abstracts
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class AbstractCase extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function successResponse(string $message, array $data): CaseResponse
    {
        return new CaseResponse(true, $message, $data);
    }

    public function errorResponse(string $message, array $data): CaseResponse
    {
        return new CaseResponse(false, $message, $data);
    }

    public function em()
    {
        return $this->manager;
    }
}