<?php

namespace App\Domain\Message;

use App\Domain\Message\Event\MessageCreatedEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class MessageRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        EntityManagerInterface $entityManager,
        ManagerRegistry $registry,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        parent::__construct($registry, Message::class);
    }

    public function create(Message $message): void
    {
        $this->entityManager->persist($message);
        $this->entityManager->flush();

        $event = new MessageCreatedEvent(
            $message->getContent(),
            $message->getRecipient(),
            $message->getSender(),
            $message->getId()
        );

        $this->eventDispatcher->dispatch($event);
    }

    public function delete(int $id): void
    {
        $message = $this->find($id);

        if (empty($message)) {
            throw new BadRequestException('Record not found');
        }

        $this->entityManager->remove($message);
        $this->entityManager->flush();
    }
}
