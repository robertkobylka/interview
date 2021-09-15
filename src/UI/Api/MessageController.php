<?php

namespace App\UI\Api;

use App\Application\Message\Command\CreateMessageCommand;
use App\Application\Message\Command\DeleteMessageCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class MessageController extends AbstractController
{
    use CommandControllerTrait;

    /**
     * @Route("/message/send", name="api.message.send",  methods={"POST"})
     */
    public function send(Request $request): JsonResponse
    {
        try {
            $this->exec(new CreateMessageCommand(
                $request->get('content'),
                $request->get('sender'),
                $request->get('recipients')
            ));

            return $this->json(['success' => true], Response::HTTP_CREATED);
        } catch (BadRequestException $e) {
            return $this->json(['success' => false], Response::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return $this->json(['success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/message/delete/{id}", name="api.message.delete",  methods={"DELETE"})
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->exec(new DeleteMessageCommand($id));

            return $this->json(['success' => true], Response::HTTP_NO_CONTENT);
        } catch (Throwable $e) {
            return $this->json(['success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
