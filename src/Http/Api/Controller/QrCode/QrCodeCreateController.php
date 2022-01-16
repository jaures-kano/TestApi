<?php

namespace App\Http\Api\Controller\QrCode;


use App\Application\QrCode\Command\CreateQrCodeCommand;
use App\Application\QrCode\Dto\QrCodeTransactionDto;
use App\Infrastructures\ParamatersChecker\ParamatersCheckerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/transaction/add", name="api_qr_code_create")
     */
    public function qrcodeCheck(Request                  $request,
                                ParamatersCheckerService $checkerService,
                                CreateQrCodeCommand      $createQrCodeCommand): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            return $this->json(['message' => 'Bad request, invalid json'], Response::HTTP_BAD_REQUEST);
        }

        /// verify if data require
        $requireData = ['designation', 'card_id', 'api_key', 'access_token'];
        $missingParameter = $checkerService->arrayCheck($data, $requireData);
        if ($missingParameter['count'] > 0) {
            return $this->json([
                'message' => 'Bad request, missed parameter '
                    . implode(", ", $missingParameter['missing'])
            ], 406);
        }

        $dto = new QrCodeTransactionDto(
            $data['designation'],
            $data['card_id'],
            $data['api_key'],
            $data['access_token']
        );

        $queryReponse = $createQrCodeCommand->createTransactionQrCode($dto);
        return $this->json($queryReponse->data, $queryReponse->status);
    }

}