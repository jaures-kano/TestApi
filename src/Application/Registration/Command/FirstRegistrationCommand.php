<?php /** @noinspection ALL */

namespace App\Application\Registration\Command;


use App\Adapter\Abstracts\AbstractCase;
use App\Application\Registration\Dto\RegistrationDto;
use App\Domain\Auth\Entity\User;
use App\Domain\Auth\Repository\UserRepository;
use App\Domain\Registration\Event\FirstRegistrationEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class FirstRegistrationCommand
 * @package App\Application\Registration\Command
 * @author jaures kano <ruddyjaures@mail.com>
 */
class FirstRegistrationCommand extends AbstractCase
{

    private EventDispatcherInterface $eventDispatcher;
    private UserPasswordHasherInterface $hasher;
    private UserRepository $userRepository;


    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(EventDispatcherInterface    $eventDispatcher,
                                UserRepository              $userRepository,
                                UserPasswordHasherInterface $hasher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
    }

    public function saveFirstRegistration(RegistrationDto $registrationDto)
    {
        $foundUser = $this->userRepository->findOneBy(['email' => $registrationDto->email]);
        if ($foundUser === null) {
            $user = new User();
            $user->setEmail($registrationDto->email);
            $user->setPhone($registrationDto->email);
            $user->setEnabledCountry($registrationDto->country);
            $user->setCreatedAt(new \DateTime());
            $user->setPassword($this->hasher->hashPassword($user, decbin(random_int(100, 300))));
            $this->em()->persist($user);
            //$this->em()->flush();

            $event = new FirstRegistrationEvent($user, $registrationDto->confirmationMode);
            $this->eventDispatcher->dispatch($event, FirstRegistrationEvent::NAME);

            return $this->successResponse('Code send to user', []);
        }
        return $this->errorResponse('Email already exist.', []);
    }

}