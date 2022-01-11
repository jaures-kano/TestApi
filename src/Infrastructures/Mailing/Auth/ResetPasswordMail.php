<?php


namespace App\Infrastructures\Mailing\Auth;


use App\Domain\AuthDomain\Auth\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * Class ResetPasswordMail
 * @package App\Infrastructures\Mailing\AuthDomain
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
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
    public function send(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from('ruddyjaures@gmail.com')
            ->to(new Address($user->getEmail()))
            ->subject("Demande de reinitialisation de mot de passe")
            ->htmlTemplate("email/AuthDomain/resetPassword.html.twig")
            ->context([
                'user' => $user
            ]);

        $this->mailer->send($email);
    }
}