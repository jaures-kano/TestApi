<?php

namespace App\Http\Api\Controller\Registration;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegistrationsApiController
 * @package App\Http\Api\Controller\Registration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationsApiController extends AbstractController
{

    /**
     * @Route("/registration/first", name="registration_first")
     */
    public function indexFistRegistration(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        return $this->json($data);
    }


}