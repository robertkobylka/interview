<?php

namespace App\Domain\Message\EventSubscriber;

use App\Application\Notification\Command\CreateNotificationCommand;
use App\Domain\Message\Event\MessageCreatedEvent;
use App\Domain\Notification\NotificationService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MessageSubscriber implements EventSubscriberInterface
{
    private const SUBSCRIBED_EVENTS = [
        MessageCreatedEvent::class => 'notify',
    ];

    private NotificationService $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public static function getSubscribedEvents(): array
    {
        return self::SUBSCRIBED_EVENTS;
    }

    public function notify(MessageCreatedEvent $event): void
    {
        $command = new CreateNotificationCommand(
            $event->title,
            $event->content,
            $event->recipient,
            $event->messageId,
            $event->sender,
        );

        $this->service->create($command);
    }
}
