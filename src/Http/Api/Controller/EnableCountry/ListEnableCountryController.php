<?php

namespace App\Http\Api\Controller\EnableCountry;


use App\Application\EnabledCountry\Query\EnabledCountryQuery;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/enable-country")
 * Class ListEnableCountryController
 * @package App\Http\Api\Controller\EnableCountry
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ListEnableCountryController extends AbstractController
{

    /**
     * @Route("/", name="api_enable_country")
     */
    public function indexListCountry(Request                  $request,
                                     EnabledCountryQuery      $enabledCountryQuery,
                                     ParamatersCheckerService $checkerService): JsonResponse
    {
        $parameters = $request->query->all();
        $missingParameter = $checkerService->arrayCheck($parameters, ['api_key']);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter '
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $queryRepone = $enabledCountryQuery->getEnabledCoubtry($parameters['api_key']);
        return $this->json($queryRepone->data, $queryRepone->status);
    }
}