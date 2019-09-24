<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function createApiResponse($data, int $statusCode): Response
    {
        if (null === $data) {
            return new Response('', $statusCode, [
                'content-type' => 'application/json'
            ]);
        }

        $serializedData = $this->serializer->serialize($data, 'json');

        return new Response($serializedData, $statusCode, [
            'content-type' => 'application/json'
        ]);
    }
}
