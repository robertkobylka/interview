<?php

namespace App\Application\Message\Command;

use App\Infrastructure\Shared\Bus\CommandInterface;

class DeleteMessageCommand implements CommandInterface
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
