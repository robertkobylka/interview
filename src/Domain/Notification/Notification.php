<?php

namespace App\Domain\Notification;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Notification\NotificationRepository")
 * @ORM\Table(name="notifications")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
class Notification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=100, nullable = false)
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     */
    protected ?string $title;

    /**
     * @ORM\Column(type="string", length=100, nullable = true)
     * @Assert\NotBlank
     * @Assert\Length(max=100)
     */
    protected ?string $description;

    /**
     * @ORM\Column(type="datetime", nullable = false)
     * @Assert\NotBlank
     */
    protected DateTime $sentDate;

    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    protected ?int $sender;

    /**
     * @ORM\Column(type="integer", nullable = false)
     * @Assert\NotBlank
     */
    protected ?int $recipient;

    public function __construct(?string $title, ?string $description, ?int $sender, ?int $recipient)
    {
        $this->title = $title;
        $this->description = $description;
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->sentDate = new DateTime();
    }
}
