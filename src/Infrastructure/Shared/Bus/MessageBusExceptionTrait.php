<?php

namespace App\Infrastructure\Shared\Bus;

use Symfony\Component\Messenger\Exception\HandlerFailedException;

trait MessageBusExceptionTrait
{
    public function throwException(HandlerFailedException $exception): void
    {
        while ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        throw $exception;
    }
}
