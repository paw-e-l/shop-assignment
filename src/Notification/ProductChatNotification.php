<?php
namespace App\Notification;

use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;

class ProductChatNotification implements ProductNotificationInterface 
{
    private $translator;
    private $chatter;

    public function __construct(ChatterInterface $chatter, TranslatorInterface $translator)
    {
        $this->translator = $translator;
        $this->chatter = $chatter;
    }

    public function send() 
    {   
        $message = (new ChatMessage($this->translator->trans('productnotification.newproducttext')))
            ->transport('discord');

        $this->chatter->send($message);   
    }
}