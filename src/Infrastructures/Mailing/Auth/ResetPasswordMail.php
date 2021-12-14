<?php


namespace App\Infrastructures\Mailing\Auth;


use App\Domain\Auth\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class ResetPasswordMail
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
    public function send(User $user)
    {
        $email = (new TemplatedEmail())
            ->from('noreply@eis.com')
            ->to(new Address($user->getEmail()))
            ->subject("Demande de reinitialisation de mot de passe")
            ->htmlTemplate("email/Auth/resetPassword.html.twig")
            ->context([]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $mailExecption) {
            throw $mailExecption;
        }
    }
}