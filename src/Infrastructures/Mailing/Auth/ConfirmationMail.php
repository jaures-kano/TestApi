<?php


namespace App\Infrastructures\Mailing\Auth;


use App\Domain\Auth\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * Class ConfirmationMail
 * @package App\Infrastructures\Mailing\Auth
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
     * @param $registrationToken
     * @throws TransportExceptionInterface
     */
    public function send(User $user, $registrationToken): void
    {
        $email = (new TemplatedEmail())
            ->from('noreply@eis.com')
            ->to(new Address($user->getEmail()))
            ->subject("confirmer votre adresse email Paie Cash")
            ->htmlTemplate("email/Auth/confirmation.html.twig")
            ->context([
                "user" => $user->getFirstName(),
                "registration_token" => $registrationToken
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $mailExecption) {
            throw $mailExecption;
        }
    }
}