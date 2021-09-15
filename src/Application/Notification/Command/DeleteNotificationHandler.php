<?php

namespace App\Application\Notification\Command;

use App\Application\CommandHandlerInterface;
use App\Domain\Notification\NotificationRepository;

class DeleteNotificationHandler implements CommandHandlerInterface
{
    private NotificationRepository $repository;

    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteNotificationCommand $command)
    {
        $this->repository->delete($command->id);
    }
}
