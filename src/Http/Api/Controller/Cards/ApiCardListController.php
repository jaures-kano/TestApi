<?php

namespace App\Http\Api\Controller\Cards;


use App\Application\Card\Query\CardQuery;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/card")
 * Class ApiCardListController
 * @package App\Http\Api\Controller\Cards
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ApiCardListController extends AbstractController
{

    /**
     * @Route("/list", name="api_card_list")
     */
    public function qrcodeCheck(Request                  $request,
                                ParamatersCheckerService $checkerService,
                                CardQuery                $query): JsonResponse
    {
        $parameters = $request->query->all();
        $missingParameter = $checkerService->arrayCheck($parameters,
            ['access_token', 'api_key']);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter '
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }


        $queryReponse = $query->getUserCard($parameters['access_token'], $parameters['api_key']);
        return $this->json($queryReponse->data, $queryReponse->status);
    }

}