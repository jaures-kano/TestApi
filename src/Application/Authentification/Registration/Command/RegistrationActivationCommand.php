<?php

namespace App\Application\Authentification\Registration\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Authentification\Registration\Dto\RegistrationActivationDto;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationActivationCommand
 * @package App\Application\AuthRegistration\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RegistrationActivationCommand extends AbstractCase
{

    private UserRepository $userRepository;
    private KeyService $keyService;

    public function __construct(UserRepository $userRepository,
                                KeyService     $keyService)
    {
        $this->userRepository = $userRepository;
        $this->keyService = $keyService;
    }

    public function activateAccount(RegistrationActivationDto $dto): CaseResponse
    {
        if ($this->keyService->isValidKey($dto->apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if (!filter_var($dto->email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::MAIL_INVALID
                ], HttpStatus::BADREQUEST);
        }

        $foundUser = $this->userRepository->findOneBy(['email' => $dto->email]);
        if ($foundUser === null) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::UNKNOW_EMAIL
                ], HttpStatus::BADREQUEST);
        }

        if ($dto->code !== $foundUser->getConfirmationToken()) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::CODE_ERROR
                ], HttpStatus::BADREQUEST);
        }

        if ($foundUser->isActived() === true) {
            return $this->errorResponse(
                [
                    'message' => 'Already actived'
                ], HttpStatus::BADREQUEST);
        }

        $foundUser->setIsActived(true);
        $foundUser->setUpdatedAt(new DateTime());
        $this->em()->persist($foundUser);
        $this->em()->flush();

        return $this->successResponse([
            'message' => 'Account activated'
        ], Response::HTTP_ACCEPTED);
    }

}