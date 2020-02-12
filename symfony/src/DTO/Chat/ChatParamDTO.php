<?php
/**
 * Created by PhpStorm.
 * User: lokalny
 * Date: 2/12/2020
 * Time: 6:06 PM
 */

namespace App\DTO\Chat;


class ChatParamDTO
{
    /**@var integer*/
    private $userId;

    /**@var string*/
    private $text;

    public function __construct(
      int $userId,
      string $text
    ) {
        $this->userId = $userId;
        $this->text = $text;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getText(): string
    {
        return $this->text;
    }

}