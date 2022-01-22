<?php

namespace App\Http\Api\Controller\Cards;


use App\Application\Card\Query\CardCheckQuery;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function indexCardCheck(Request                  $request,
                                   ParamatersCheckerService $checkerService,
                                   CardCheckQuery           $query): JsonResponse
    {
        $parameters = $request->query->all();
        $missingParameter = $checkerService->arrayCheck($parameters,
            ['access_token', 'api_key', 'email']);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter '
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $queryReponse = $query->checkCard(
            $parameters['access_token'],
            $parameters['api_key'],
            $parameters['email']);
        return $this->json($queryReponse->data, $queryReponse->status);
    }
}