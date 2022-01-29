<?php /** @noinspection ALL */

namespace App\Application\Authentification\Registration\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Adapter\CaseMessage;
use App\Adapter\HttpStatus;
use App\Adapter\Response\CaseResponse;
use App\Application\ApplicationKey\KeyService;
use App\Application\Authentification\Registration\Dto\SocialRegistrationDto;
use App\Domain\AuthDomain\Auth\Entity\User;
use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use App\Infrastructures\JwtToken\JwtService;
use DateTime;

/**
 * Class RegistrationCommand
 * @package App\Application\AuthRegistration\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class SocialRegistrationCommand extends AbstractCase
{
    private const SERVICE = ['facebook', 'google'];

    private UserRepository $userRepository;
    private KeyService $keyService;
    private JwtService $jwtService;

    public function __construct(UserRepository $userRepository,
                                JwtService     $jwtService,
                                KeyService     $keyService)
    {
        $this->userRepository = $userRepository;
        $this->keyService = $keyService;
        $this->jwtService = $jwtService;
    }

    public function registration(SocialRegistrationDto $registrationDto, $service): CaseResponse
    {
        if ($this->keyService->isValidKey($registrationDto->apiKey) === false) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::INVALID_KEY
                ], HttpStatus::BADREQUEST);
        }

        if (!filter_var($registrationDto->email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse(
                [
                    'message' => CaseMessage::MAIL_INVALID
                ], HttpStatus::BADREQUEST);
        }

        if (in_array($service, self::SERVICE, true) === false) {
            return $this->errorResponse(
                [
                    'message' => 'Unknow service'
                ], HttpStatus::BADREQUEST);
        }

        $foundUser = $this->userRepository->findOneBy(['email' => $registrationDto->email]);

        $user = $foundUser ?? new User();
        $foundUser === null ? $user->setEmail($registrationDto->email) : null;
        $foundUser === null ? $user->setFirstName($registrationDto->firstName) : null;
        $user->setIsActived(true);
        $service === self::SERVICE[0] ? $user->setFacebookId($registrationDto->accountId) : null;
        $service === self::SERVICE[1] ? $user->setGoogleId($registrationDto->accountId) : null;
        $foundUser === null ? $user->setCreatedAt(new DateTime()) : null;
        $foundUser === null ? $user->setLastLoginAt(new DateTime()) : null;
        $this->em()->persist($user);
        $this->em()->flush();

        $jwt = $this->jwtService->createNewJWT($user);
        return $this->successResponse(
            [
                'message' => 'successfull login!',
                'user' => [
                    'id' => $user->getId(),
                    'google_id' => $user->getGoogleId(),
                    'facebook_id' => $user->getFacebookId(),
                    'email' => $user->getEmail(),
                    'lastName' => $user->getLastName(),
                    'firstName' => $user->getFirstName(),
                    'lastLoginAt' => $user->getLastLoginAt(),
                    'createdAt' => $user->getCreatedAt(),
                    'updatedAt' => $user->getUpdatedAt(),
                ],
                'token' => $jwt['token'],
                'refresh_token' => $jwt['refresh_refresh'],
                'expired_at' => $jwt['expired_at']
            ], HttpStatus::CREATED);
    }

}