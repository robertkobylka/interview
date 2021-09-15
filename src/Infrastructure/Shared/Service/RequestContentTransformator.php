<?php

namespace App\Infrastructure\Shared\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestContentTransformator
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $content = $request->getContent();
        if (empty($content)) {
            return;
        }
        if (!$this->isJsonRequest($request)) {
            return;
        }
        $this->transformJsonBody($request);
    }

    private function isJsonRequest(Request $request): bool
    {
        return 'json' === $request->getContentType();
    }

    private function transformJsonBody(Request $request): void
    {
        $data = json_decode($request->getContent(), true);
        if (json_last_error() == JSON_ERROR_NONE && $data !== null) {
            $request->request->replace($data);
        }
    }
}
