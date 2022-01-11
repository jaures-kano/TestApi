<?php

namespace App\Infrastructures\Mailing\Subscriber;


use App\Domain\AuthDomain\AuthRegistration\Event\FirstRegistrationEvent;
use App\Infrastructures\Mailing\Auth\ConfirmationMail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class FirstRegistrationSubscriber
 * @package App\Application\AuthRegistration\EventSubcriber
 * @author jaures kano <ruddyjaures@mail.com>
 */
class FirstRegistrationSubscriber implements EventSubscriberInterface
{
    private ConfirmationMail $confirmationMail;

    /**
     * @param ConfirmationMail $confirmationMail
     */
    public function __construct(ConfirmationMail $confirmationMail)
    {
        $this->confirmationMail = $confirmationMail;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FirstRegistrationEvent::NAME => 'sendFirstRegistrationMail'
        ];
    }

    public function sendFirstRegistrationMail(FirstRegistrationEvent $event): void
    {
        if ($event->getMode() === true) {
            $this->confirmationMail->send($event->getUser());
        }
    }


}