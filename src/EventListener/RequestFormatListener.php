<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Negotiation\ContentNegotiator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestFormatListener implements EventSubscriberInterface
{
    private $contentNegotiator;

    public function __construct(ContentNegotiator $contentNegotiator)
    {
        $this->contentNegotiator = $contentNegotiator;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['onKernelRequest', 8],
            ],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $acceptHeader = $this->contentNegotiator->getNegotiatedAcceptHeader($request);

        if (null === $acceptHeader) {
            // default request format is json defined on the routes
            return;
        }

        $request->setRequestFormat($acceptHeader->getSubPart());
    }
}
