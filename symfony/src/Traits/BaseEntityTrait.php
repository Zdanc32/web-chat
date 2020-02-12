<?php
/**
 * Created by PhpStorm.
 * User: lokalny
 * Date: 2/12/2020
 * Time: 1:36 PM
 */


namespace App\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait BaseEntityTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"chat-base"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     * @Groups({"chat-base"})
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}