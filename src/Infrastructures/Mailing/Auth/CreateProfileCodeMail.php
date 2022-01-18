<?php

namespace App\Infrastructures\Mailing\Auth;


use App\Domain\AuthDomain\Auth\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * Class CreateProfileCodeMail
 * @package App\Infrastructures\Mailing\AuthDomain
 * @author jaures kano <ruddyjaures@mail.com>
 */
class CreateProfileCodeMail
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param User $user
     * @throws TransportExceptionInterface
     */
    public function send(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from('noreply@eis.com')
            ->to(new Address($user->getEmail()))
            ->subject("Demande de reinitialisation de mot de passe")
            ->htmlTemplate("email/Auth/resetPassword.html.twig")
            ->context([
                'user' => $user
            ]);

        $this->mailer->send($email);
    }

}