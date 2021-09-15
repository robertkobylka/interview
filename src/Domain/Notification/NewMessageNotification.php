<?php

namespace App\Domain\Notification;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class NewMessageNotification extends Notification
{
    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    protected ?int $messageId;

    /**
     * @Assert\NotBlank
     */
    protected ?int $sender;

    public function __construct(?string $title, ?string $description, ?int $sender, ?int $recipient, ?int $messageId)
    {
        parent::__construct($title, $description, $sender, $recipient);
        $this->messageId = $messageId;
    }
}
