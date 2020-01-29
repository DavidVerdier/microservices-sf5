<?php

namespace App\Services;

use App\Entity\Mails;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer
{
    private $mailer;

    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param Mails $mails
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function send(Mails $mails)
    {
        $html = $this->buildHtml($mails);

        $email = (new Email())
            ->from($mails->getFromEmail())
            ->to($mails->getToEmails()->first()->getEmail())
            ->subject("Test mail " . $mails->getType())
            ->html($html)
        //    ->attachFromPath($originalFile)
        ;

        $this->mailer->send($email);
    }

    /**
     * @param Mails $mails
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function buildHtml(Mails $mails): string
    {
        $template = sprintf('emails/%s.html.twig', $mails->getType());

        $data = json_decode( $mails->getData(), true);

        return $this->twig->render($template,  $data ? $data : []);
    }
}
