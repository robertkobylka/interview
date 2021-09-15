<?php

namespace App\Application\Message\Command;

use App\Infrastructure\Shared\Bus\CommandInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateMessageCommand implements CommandInterface
{
    public ?string $content;
    public ?int $sender;
    public ?array $recipients;

    public function __construct(?string $content, ?int $sender, ?array $recipients)
    {
        $this->content = $content;
        $this->sender = $sender;

        if (empty($recipients)) {
            throw new BadRequestException();
        }

        $this->recipients = $recipients;
    }
}
