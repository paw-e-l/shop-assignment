<?php
namespace App\Notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductMailNotification implements ProductNotificationInterface 
{
    private $mailer;
    private $translator;

    public function __construct(MailerInterface $mailer, TranslatorInterface $translator)
    {
        $this->mailer = $mailer;
        $this->translator = $translator;
    }

    public function send() 
    {
        $email = (new Email())
            ->to('you@example.com') // TODO: fetch e-mail recipients from config/database
            ->subject($this->translator->trans('productnotification.newproducttitle'))
            ->text($this->translator->trans('productnotification.newproducttext'));

        $this->mailer->send($email);        
    }
}