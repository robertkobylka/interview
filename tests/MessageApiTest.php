<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MessageApiTest extends WebTestCase
{
    public function testSendResponse(): void
    {
        $expectedResponse = ['success' => true];
        $data = [
            'content' => 'lorem ipsum',
            'sender' => 10,
            'recipients' => [1, 2, 3],
        ];

        $client = static::createClient(['HTTP_HOST' => '0.0.0.0:8080']);

        $client->request('POST', 'api/message/send', $data);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertResponseFormatSame('json');
        $this->assertSame($client->getResponse()->getContent(), json_encode($expectedResponse));
    }

    public function testInvalidSendReponse(): void
    {
        $expectedResponse = ['success' => false];
        $client = static::createClient(['HTTP_HOST' => '0.0.0.0:8080']);

        $client->request('POST', 'api/message/send');

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertResponseFormatSame('json');
        $this->assertSame($client->getResponse()->getContent(), json_encode($expectedResponse));
    }
}
