<?php

namespace App\Application\Authentification\Auth\Listenners;


use App\Domain\AuthDomain\Auth\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;

class LoginListenner
{

    private EntityManagerInterface $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onSecurityAuthenticationSuccess(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();
        $dateTime = new DateTime();

        if ($user !== null) {
            assert($user instanceof User);
            $user->setLastLoginAt($dateTime);
            $this->em->persist($user);
            $this->em->flush();
        }

    }
}