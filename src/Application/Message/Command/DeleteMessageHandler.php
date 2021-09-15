<?php

namespace App\Application\Message\Command;

use App\Application\CommandHandlerInterface;
use App\Domain\Message\MessageRepository;

class DeleteMessageHandler implements CommandHandlerInterface
{
    private MessageRepository $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteMessageCommand $command)
    {
        $this->repository->delete($command->id);
    }
}
