<?php

namespace App\Domain;

use App\Application\Notification\Command\CreateNotificationCommand;
use App\Domain\Notification\NewMessageNotification;
use App\Domain\Notification\Notification;
use App\Domain\Notification\SystemNotification;

class NotificationFactory
{
    public static function createFromCommand(CreateNotificationCommand $command): Notification
    {
        switch ($command->messageId) {
            case null:
                return new SystemNotification(
                    $command->title,
                    $command->description,
                    $command->sender,
                    $command->recipient
                );
            default:
                return new NewMessageNotification(
                    $command->title,
                    $command->description,
                    $command->sender,
                    $command->recipient,
                    $command->messageId
                );
        }
    }
}
