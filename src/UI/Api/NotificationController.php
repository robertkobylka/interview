<?php

namespace App\UI\Api;

use App\Application\Notification\Command\CreateNotificationCommand;
use App\Application\Notification\Command\DeleteNotificationCommand;
use App\Domain\Notification\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class NotificationController extends AbstractController
{
    private NotificationService $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/notification/send", name="api.notification.send",  methods={"POST"})
     */
    public function send(Request $request): JsonResponse
    {
        try {
            $this->service->create(new CreateNotificationCommand(
                $request->get('title'),
                $request->get('description'),
                $request->get('recipient'),
                $request->get('messageId'),
                $request->get('sender')
            ));

            return $this->json(['success' => true], Response::HTTP_CREATED);
        } catch (BadRequestException $e) {
            return $this->json(['success' => false], Response::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return $this->json(['success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/notification/delete/{id}", name="api.notification.delete",  methods={"DELETE"})
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->service->delete(new DeleteNotificationCommand($id));

            return $this->json(['success' => true], Response::HTTP_NO_CONTENT);
        } catch (Throwable $e) {
            return $this->json(['success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
