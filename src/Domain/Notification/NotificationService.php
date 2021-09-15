<?php

namespace App\Domain\Notification;

use App\Application\Notification\Command\CreateNotificationCommand;
use App\UI\Api\CommandControllerTrait;

class NotificationService
{
    use CommandControllerTrait;

    public function create(CreateNotificationCommand $command): void
    {
        $this->exec($command);
    }
}
