<?php

declare(strict_types=1);

namespace App\Negotiation;

use Negotiation\AcceptHeader;
use Negotiation\Negotiator;
use Symfony\Component\HttpFoundation\Request;

class ContentNegotiator
{
    private const ACCEPTED_CONTENT_TYPES = [
        'application/json',
        'application/xml',
        'text/xml',
    ];

    /**
     * @var Negotiator
     */
    private $negotiator;

    public function __construct()
    {
        $this->negotiator = new Negotiator();
    }

    public function getNegotiatedAcceptHeader(Request $request): ?AcceptHeader
    {
        $acceptableContentTypes = $request->getAcceptableContentTypes();

        if (1 === count($acceptableContentTypes) && "*/*" === $acceptableContentTypes[0]) {
            return null;
        }

        return $this->negotiator->getBest(
            implode(',', $request->getAcceptableContentTypes()),
            self::ACCEPTED_CONTENT_TYPES
        );
    }
}
