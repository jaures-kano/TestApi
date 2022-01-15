<?php

namespace App\Infrastructures\Mailing\Subscriber;


use App\Domain\ProfileDomain\Event\PasswordRequestEvent;
use App\Infrastructures\Mailing\Auth\ResetPasswordMail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class PasswordResetSubscriber
 * @package App\Infrastructures\Mailing\Subscriber
 * @author jaures kano <ruddyjaures@mail.com>
 */
class PasswordResetSubscriber implements EventSubscriberInterface
{
    private ResetPasswordMail $resetPasswordMail;

    /**
     * @param ResetPasswordMail $resetPasswordMail
     */
    public function __construct(ResetPasswordMail $resetPasswordMail)
    {
        $this->resetPasswordMail = $resetPasswordMail;
    }


    public static function getSubscribedEvents(): array
    {
        return [
            PasswordRequestEvent::NAME => 'onRequestResetPassword'
        ];
    }

    public function onRequestResetPassword(PasswordRequestEvent $event): void
    {
        if ($event->getMode() === true) {
            $this->resetPasswordMail->send($event->getUserRequest());
        }
    }


}