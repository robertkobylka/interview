<?php

namespace App\UI\Api;

use App\Infrastructure\Shared\Bus\CommandBus;
use App\Infrastructure\Shared\Bus\CommandInterface;

trait CommandControllerTrait
{
    private CommandBus $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    protected function exec(CommandInterface $command, array $stamps = []): void
    {
        $this->bus->handle($command, $stamps);
    }
}
