<?php

namespace App\Application\Notification\Command;

use App\Infrastructure\Shared\Bus\CommandInterface;

class CreateNotificationCommand implements CommandInterface
{
    public ?string $title;
    public ?string $description;
    public ?int $sender;
    public ?int $recipient;
    public ?int $messageId;

    public function __construct(?string $title, ?string $description, ?int $recipient, ?int $messageId = null, ?int $sender = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->messageId = $messageId;
    }
}
