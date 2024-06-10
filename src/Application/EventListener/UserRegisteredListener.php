<?php
// src/Application/EventListener/UserRegisteredListener.php

namespace App\Application\EventListener;

use App\Application\Message\SendEmailMessage;
use App\Domain\Event\UserRegisteredEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class UserRegisteredListener implements EventSubscriberInterface
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserRegisteredEvent::class => 'onUserRegistered',
        ];
    }

    /**
     * @throws ExceptionInterface
     */
    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        $this->messageBus->dispatch(new SendEmailMessage($user));
    }
}
