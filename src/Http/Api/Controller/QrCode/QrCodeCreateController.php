<?php

namespace App\Http\Api\Controller\QrCode;


use App\Application\QrCode\Query\CheckQrCodeQuery;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/qr_code")
 * Class QrCodeCheckController
 * @package App\Http\Api\Controller\QrCode
 * @author jaures kano <ruddyjaures@mail.com>
 */
class QrCodeCreateController extends AbstractController
{

    /**
     * @Route("/create", name="api_qr_code_create")
     */
    public function qrcodeCheck(Request                  $request,
                                ParamatersCheckerService $checkerService,
                                CheckQrCodeQuery         $checkQrCodeQuery): JsonResponse
    {
        $parameters = $request->query->all();
        $missingParameter = $checkerService->arrayCheck($parameters, ['card_id', 'api_key']);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter '
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $queryReponse = $checkQrCodeQuery->check($parameters['code'], $parameters['api_key']);
        return $this->json($queryReponse->data, $queryReponse->status);
    }

}