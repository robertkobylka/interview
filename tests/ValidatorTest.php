<?php

namespace App\Tests;

use App\Application\Notification\Command\CreateNotificationCommand;
use App\Domain\NotificationFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ValidatorTest extends TestCase
{
    /**
     * @dataProvider itemsProvider
     */
    public function testNotificationValidation(CreateNotificationCommand $command, int $expectedErrors): void
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate(NotificationFactory::createFromCommand($command));
        $this->assertEquals(count($errors), $expectedErrors);
    }

    public function itemsProvider(): array
    {
        return [
            [new CreateNotificationCommand('test', 'test', 1), 0],
            [new CreateNotificationCommand('te', 'test', 1), 1],
            [new CreateNotificationCommand(null, null, null), 3],
            [new CreateNotificationCommand('test', 'test', 1, 2, 3, null), 0],
            [new CreateNotificationCommand('test', 'test', null, 2, 3, 3), 1],
        ];
    }
}
