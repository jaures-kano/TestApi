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
class QrCodeCheckController extends AbstractController
{

    /**
     * @Route("/check", name="api_qr_code_check")
     */
    public function qrcodeCheck(Request                  $request,
                                ParamatersCheckerService $checkerService,
                                CheckQrCodeQuery         $checkQrCodeQuery): JsonResponse
    {
        $parameters = $request->query->all();
        $missingParameter = $checkerService->arrayCheck($parameters,
            ['code', 'api_key']);
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