<?php


namespace App\Infrastructures\Mailing\Auth;


use App\Domain\ProfileDomain\Entity\UserRecoveryRequest;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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

    public function send(UserRecoveryRequest $userRecoveryRequest): void
    {
        $email = (new TemplatedEmail())
            ->from('ruddyjaures@gmail.com')
            ->to(new Address($userRecoveryRequest->getUser()->getEmail()))
            ->subject("Demande de reinitialisation de mot de passe")
            ->htmlTemplate("email/Auth/resetPassword.html.twig")
            ->context([
                'user' => $userRecoveryRequest->getUser(),
                'request' => $userRecoveryRequest,
            ]);

        $this->mailer->send($email);
    }
}