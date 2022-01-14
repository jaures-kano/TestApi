<?php


namespace App\Adapter\Abstracts;


use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Infrastructures\JwtToken\JwtService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AbstractCase
 * @package App\Adapter\Abstracts
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class AbstractCase extends AbstractController
{

    private KeyService $keyService;

    private JwtService $jwtService;

    public function __construct(KeyService $keyService, JwtService $jwtService)
    {
        $this->keyService = $keyService;
        $this->jwtService = $jwtService;
    }


    public function isValidApikey(string $token): bool
    {
        return $this->keyService->isValidKey($token);
    }


    public function isUserTokenValid(User $user, string $token): bool
    {
        return $this->jwtService->isValidUserToken($user, $token);
    }


    public function successResponse(string $message, array $data, $status = 200): CaseResponse
    {
        return new CaseResponse(true, $message, $data, $status);
    }

    public function errorResponse(string $message, array $data, $status = 200): CaseResponse
    {
        return new CaseResponse(false, $message, $data, $status);
    }

    public function em()
    {
        return $this->getDoctrine()->getManager();
    }
}