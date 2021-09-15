<?php

namespace App\Application\Notification\Command;

use App\Infrastructure\Shared\Bus\CommandInterface;

class DeleteNotificationCommand implements CommandInterface
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
