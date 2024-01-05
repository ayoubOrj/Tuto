<?php

declare(strict_types=1);

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEventS;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public static function getSubscribedEvents()
    {
        return [
            KernelEventS::VIEW => ["encoderPassword", EventPriorities::POST_WRITE]
        ];
    }

    public function encoderPassword(ViewEvent $event): void
    {
        $user = $event->getControllerResult();

        if ($user instanceof User) {
            $passHash = $this->encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($passHash);
        }
    }
}
