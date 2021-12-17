<?php

namespace App\Infrastructures\Mailing\Subscriber;


use App\Domain\Profile\Event\PasswordRequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class PasswordResetSubscriber
 * @package App\Infrastructures\Mailing\Subscriber
 * @author jaures kano <ruddyjaures@mail.com>
 */
class PasswordResetSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            PasswordRequestEvent::NAME => 'onRequestResetPassword'
        ];
    }

    public function onRequestResetPassword(PasswordRequestEvent $event): void
    {

    }


}