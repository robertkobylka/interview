<?php

namespace App\Domain\Message\Event;

use Symfony\Contracts\EventDispatcher\Event;

class MessageCreatedEvent extends Event
{
    private const TITLE = 'You have a new message';

    public string $title;
    public string $content;
    public int $recipient;
    public int $messageId;
    public int $sender;

    public function __construct(string $content, int $recipient, int $sender, int $messageId)
    {
        $this->title = self::TITLE;
        $this->content = $content;
        $this->recipient = $recipient;
        $this->messageId = $messageId;
        $this->sender = $sender;
    }
}
