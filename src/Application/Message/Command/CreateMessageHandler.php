<?php

namespace App\Application\Message\Command;

use App\Application\CommandHandlerInterface;
use App\Domain\Message\Message;
use App\Domain\Message\MessageRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateMessageHandler implements CommandHandlerInterface
{
    private MessageRepository $repository;
    private ValidatorInterface $validator;

    public function __construct(MessageRepository $repository, ValidatorInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function __invoke(CreateMessageCommand $command)
    {
        foreach ($command->recipients as $recipient) {
            $message = new Message($command->content, $command->sender, $recipient);

            $errors = $this->validator->validate($message);
            if (count($errors) > 0) {
                throw new BadRequestException();
            }

            $this->repository->create($message);
        }
    }
}
