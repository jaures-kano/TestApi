<?php

namespace App\Infrastructures\Mailing\Subscriber;


use App\Domain\Registration\Event\FirstRegistrationEvent;
use App\Infrastructures\Mailing\Auth\CreateProfileCodeMail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class FirstRegistrationSubscriber
 * @package App\Application\Registration\EventSubcriber
 * @author jaures kano <ruddyjaures@mail.com>
 */
class FirstRegistrationSubscriber implements EventSubscriberInterface
{
    private CreateProfileCodeMail $createProfileCodeMail;

    /**
     * @param CreateProfileCodeMail $createProfileCodeMail
     */
    public function __construct(CreateProfileCodeMail $createProfileCodeMail)
    {
        $this->createProfileCodeMail = $createProfileCodeMail;
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
            $this->createProfileCodeMail->send($event->getUser());
        }
    }


}