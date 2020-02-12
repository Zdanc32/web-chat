<?php
/**
 * Created by PhpStorm.
 * User: lokalny
 * Date: 2/12/2020
 * Time: 7:10 PM
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Constants\ErrorMessageConst;
use App\Entity\User;
use App\Service\User\CheckUserExistingService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterSubscriber implements EventSubscriberInterface
{
    private $userPasswordEncoder;
    private $checkUserExistingService;

    public function __construct(
      CheckUserExistingService $checkUserExistingService,
      UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->checkUserExistingService = $checkUserExistingService;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['registerUser', EventPriorities::PRE_WRITE],
        ];
    }

    public function registerUser(ViewEvent $event)
    {
        $newUser = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$newUser instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        if ($this->checkUserExistingService->execute($newUser->getEmail())) {
            throw new BadRequestHttpException(ErrorMessageConst::ALREADY_EXIST);
        }

        $newUser->setPassword(
            $this->userPasswordEncoder->encodePassword($newUser, $newUser->getPassword())
        );
    }
}