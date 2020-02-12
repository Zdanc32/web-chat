<?php
/**
 * Created by PhpStorm.
 * User: lokalny
 * Date: 2/12/2020
 * Time: 8:10 PM
 */

namespace App\Service\User;


use App\Repository\UserRepository;

class CheckUserExistingService
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute(
        string $email
    ): bool {
        return $this->userRepository->findBy(['email' => $email]) ? true : false;
    }
}