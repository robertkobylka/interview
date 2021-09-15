<?php

namespace App\Tests;

use App\Application\Notification\Command\CreateNotificationCommand;
use App\Domain\Notification\NewMessageNotification;
use App\Domain\Notification\SystemNotification;
use App\Domain\NotificationFactory;
use PHPUnit\Framework\TestCase;

class NotificationFactoryTest extends TestCase
{
    /**
     * @dataProvider itemsProvider
     */
    public function testCreateFromCommand(CreateNotificationCommand $command, $expectedClass): void
    {
        $this->assertSame(get_class(NotificationFactory::createFromCommand($command)), $expectedClass);
    }

    public function itemsProvider(): array
    {
        return [
            [new CreateNotificationCommand('test', 'test', 1), SystemNotification::class],
            [new CreateNotificationCommand('test', 'test', 1, 2, 3), NewMessageNotification::class],
        ];
    }
}
