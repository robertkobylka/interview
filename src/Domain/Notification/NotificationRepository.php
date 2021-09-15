<?php

namespace App\Domain\Notification;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class NotificationRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $registry)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Notification::class);
    }

    public function create(Notification $notification): void
    {
        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    public function delete(int $id): void
    {
        $notification = $this->find($id);

        if (empty($notification)) {
            throw new BadRequestException('Record not found');
        }

        $this->entityManager->remove($notification);
        $this->entityManager->flush();
    }
}
