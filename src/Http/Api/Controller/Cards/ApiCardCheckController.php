<?php

namespace App\Http\Api\Controller\Cards;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/card")
 * Class ApiCardCheckController
 * @package App\Http\Api\Controller\Cards
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiCardCheckController extends AbstractController
{

    /**
     * @Route("/check", name="api_card_check")
     */
    public function indexCardCheck()
    {

        return $this->json();
    }
}