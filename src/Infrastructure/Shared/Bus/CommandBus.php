<?php

namespace App\Infrastructure\Shared\Bus;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus
{
    use MessageBusExceptionTrait;

    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function handle(CommandInterface $command, array $stamps = [])
    {
        try {
            $this->bus->dispatch((new Envelope($command, $stamps)));
        } catch (HandlerFailedException $e) {
            $this->throwException($e);
        }
    }
}
