<?php

namespace App\Domain\Message;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Message\MessageRepository")
 * @ORM\Table(name="messages")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=100, nullable = false)
     * @Assert\Length(min=3, max=100)
     * @Assert\NotBlank
     */
    private ?string $content;

    /**
     * @ORM\Column(type="integer", nullable = false)
     * @Assert\NotBlank
     */
    protected ?int $sender;

    /**
     * @ORM\Column(type="integer", nullable = false)
     * @Assert\NotBlank
     */
    protected ?int $recipient;

    public function __construct(?string $content, ?int $sender, ?int $recipient)
    {
        $this->content = $content;
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getSender(): ?int
    {
        return $this->sender;
    }

    public function getRecipient(): ?int
    {
        return $this->recipient;
    }
}
