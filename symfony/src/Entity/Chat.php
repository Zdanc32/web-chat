<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\BaseEntityTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChatRepository")
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"chat-base"}
 *              }
 *          },
 *          "post"={
 *              "denormalization_context"={
 *                  "groups"={"input-text"}
 *              },
 *              "security"="is_granted('ROLE_USER')"
 *          }
 *     },
 *     itemOperations={
 *          "get"
 *     }
 * ))
 */
class Chat
{
    use BaseEntityTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"chat-base", "input-text"})
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @Groups({"chat-base"})
     */
    private $user;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
