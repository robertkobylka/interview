<?php

namespace App\Application\Notification\Command;

use App\Application\CommandHandlerInterface;
use App\Domain\Notification\NotificationRepository;
use App\Domain\NotificationFactory;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateNotificationHandler implements CommandHandlerInterface
{
    private NotificationRepository $repository;
    private ValidatorInterface $validator;

    public function __construct(NotificationRepository $repository, ValidatorInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function __invoke(CreateNotificationCommand $command)
    {
        $notification = NotificationFactory::createFromCommand($command);

        $errors = $this->validator->validate($notification);
        if (count($errors) > 0) {
            throw new BadRequestException();
        }

        $this->repository->create($notification);
    }
}
