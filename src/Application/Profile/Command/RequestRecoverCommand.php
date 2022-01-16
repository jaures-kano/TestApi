<?php /** @noinspection PhpExpressionResultUnusedInspection */

namespace App\Application\Profile\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Domain\ProfileDomain\Entity\UserRecoveryRequest;
use App\Domain\ProfileDomain\Event\PasswordRequestEvent;
use App\Domain\ProfileDomain\Repository\UserRecoveryRequestRepository;
use App\Infrastructures\Generator\TokenGenerator;
use DateTime;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class AccountRecoverCommand
 * @package App\Application\ProfileDomain\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class RequestRecoverCommand extends AbstractCase
{

    private EventDispatcherInterface $eventDispatcher;
    private UserRepository $userRepository;
    private KeyService $keyService;
    private UserRecoveryRequestRepository $userRecoveryRRepository;
    private TokenGenerator $tokenGenerator;

    public function __construct(EventDispatcherInterface      $eventDispatcher,
                                UserRepository                $userRepository,
                                TokenGenerator                $tokenGenerator,
                                UserRecoveryRequestRepository $userRecoveryRRepository,
                                KeyService                    $keyService)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->userRepository = $userRepository;
        $this->keyService = $keyService;
        $this->userRecoveryRRepository = $userRecoveryRRepository;
        $this->tokenGenerator = $tokenGenerator;
    }

    public function recoverPassword($email, $mode, $apiKey): CaseResponse
    {
        if ($this->keyService->isValidKey($apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::MAIL_INVALID
                ], HttpStatus::BADREQUEST);
        }

        $foundUser = $this->userRepository->findOneBy(['email' => $email]);
        if ($foundUser === null) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::UNKNOW_EMAIL
                ], HttpStatus::BADREQUEST);
        }

        $requestSend = $this->userRecoveryRRepository->findOneBy(['isValidate' => false]);
        $requestRecovery = $requestSend ?? new UserRecoveryRequest();
        $requestRecovery->setConfirmationToken($this->tokenGenerator->getAuthToken());
        $requestRecovery->setExpiredAt(new DateTime('+30 minutes'));
        $requestSend === null ? $requestRecovery->setRequestAt(new DateTime()) : null;
        $requestSend === null ? $requestRecovery->setUser($foundUser) : null;

        $this->em()->persist($requestRecovery);
        $this->em()->flush();

        $event = new PasswordRequestEvent($requestRecovery, $mode);
        $this->eventDispatcher->dispatch($event, $event::NAME);

        $message = 'Un Email a ete envoye a votre avec un code de confirmation';
        $mode === false && $message = 'Un Sms a ete envoye a votre avec un code de confirmation';

        return $this->successResponse([
            'message' => $message
        ], HttpStatus::ACCEPTED);

    }


}