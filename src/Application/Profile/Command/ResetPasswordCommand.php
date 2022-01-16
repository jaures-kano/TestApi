<?php

namespace App\Application\Profile\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Profile\Dto\ResetPasswordDto;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Domain\ProfileDomain\Repository\UserRecoveryRequestRepository;
use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class ChangePasswordCommand
 * @package App\Application\ProfileDomain\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class ResetPasswordCommand extends AbstractCase
{

    private KeyService $keyService;
    private UserRecoveryRequestRepository $repositoryRequest;
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserRecoveryRequestRepository $repositoryRequest,
                                UserRepository                $userRepository,
                                UserPasswordHasherInterface   $hasher,
                                KeyService                    $keyService)
    {
        $this->keyService = $keyService;
        $this->repositoryRequest = $repositoryRequest;
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    public function resetPassword(ResetPasswordDto $dto): CaseResponse
    {

        if ($this->keyService->isValidKey($dto->apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if ($dto->passwordConfirm !== $dto->password) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::CODE_ERROR
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

        $ifRequest = $this->repositoryRequest->findOneBy(['isValidate' => false, 'user' => $foundUser]);
        if ($ifRequest === null) {
            return $this->errorResponse(
                [
                    'message' => 'User d\'ont request to resetting his password'
                ], HttpStatus::FORBIDEN);
        }

        if ($ifRequest->getConfirmationToken() !== $dto->confirmationCode) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::CODE_INVALID
                ], HttpStatus::BADREQUEST);
        }

        $ifRequest->setIsValidate(true);
        $ifRequest->setValidateAt(new DateTime());
        $this->em()->persist($ifRequest);
        $this->em()->flush();

        $foundUser->setPassword($this->hasher->hashPassword($foundUser, $dto->password));
        $this->em()->persist($foundUser);
        $this->em()->flush();

        return $this->successResponse([
            'message' => 'Password is reset'
        ], HttpStatus::ACCEPTED);
    }


}