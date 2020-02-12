<?php
/**
 * Created by PhpStorm.
 * User: lokalny
 * Date: 2/12/2020
 * Time: 7:10 PM
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Chat;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class SendMessageSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(
      Security $security
    ) {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMessage', EventPriorities::PRE_WRITE],
        ];
    }

    public function sendMessage(ViewEvent $event)
    {
        $newMessage = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$newMessage instanceof Chat || Request::METHOD_POST !== $method) {
            return;
        }

        $newMessage->setUser($this->security->getUser());
    }
}