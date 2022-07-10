<?php

namespace App\Service;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailService {
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendEmail(
        string $from,
        string $subject,
        string $htmlTemplate,
        array $context,
        string $to = 'cedgonzalezdevcda@gmail.com'
    ): void {
        $email = (new TemplatedEmail())
            ->from($from)
            ->subject($subject)
            ->htmlTemplate($htmlTemplate)
            ->context($context)
            ->to($to);

        $this->mailer->send($email);
    }

}
