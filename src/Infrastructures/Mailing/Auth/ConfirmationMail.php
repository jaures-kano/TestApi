<?php


namespace App\Infrastructures\Mailing\Auth;


use App\Domain\AuthDomain\Auth\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * Class ConfirmationMail
 * @package App\Infrastructures\Mailing\AuthDomain
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class ConfirmationMail
{

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param User $user
     */
    public function send(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from('ruddyjaures@gmail.com')
            ->to(new Address($user->getEmail()))
            ->subject("confirmer votre adresse email Paie Cash")
            ->htmlTemplate("email/Auth/confirmation.html.twig")
            ->context([
                "user" => $user
            ]);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $mailExecption) {

        }
    }
}