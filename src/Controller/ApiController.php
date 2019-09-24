<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function createApiResponse(Request $request, $data, int $statusCode = Response::HTTP_OK): Response
    {
        if (null === $data) {
            return new Response('', $statusCode);
        }

        $dataSerialized = $this->serializer->serialize($data, $request->getRequestFormat());

        return new Response($dataSerialized, $statusCode);
    }
}
