<?php
declare(strict_types= 1);

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Article;
use Symfony\Component\EventDispatcher\EventSubscriberInterface ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEventS;
use Symfony\Component\Security\Core\Security;

class CurrentUserForArticlesSubscriber implements EventSubscriberInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public static function getSubscribedEvents()
    {
        return [
        KernelEventS::VIEW => ["CurrentUserForArticles", EventPriorities::PRE_VALIDATE]
        ];
    }

    public function CurrentUserForArticles(ViewEvent $event): void
    {
        $article = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if( $article instanceof Article && Request::METHOD_POST === $method)
        {
            $article->setAuthor($this->security->getUser());
        }
    }
}