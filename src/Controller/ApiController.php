<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiController
{
    private $serializer;
    private $validator;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    protected function deserializeRequestContent(Request $request, string $type)
    {
        $entity = $this->serializer->deserialize($request->getContent(), $type, $request->getRequestFormat());

        $validationErrors = $this->validator->validate($entity);

        if (\count($validationErrors) > 0) {
            // throw a BadRequestHttpException for now, we will introduce proper ApiExceptions later
            throw new BadRequestHttpException();
        }

        return $entity;
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
