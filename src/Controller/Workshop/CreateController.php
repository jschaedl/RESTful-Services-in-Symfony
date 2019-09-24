<?php

declare(strict_types=1);

namespace App\Controller\Workshop;

use App\Controller\ApiController;
use App\Entity\Workshop;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/workshops", name="create_workshop", methods={"POST"}, format="json")
 */
class CreateController extends ApiController
{
    private $entityManager;
    private $urlGenerator;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $urlGenerator
    ) {
        parent::__construct($serializer, $validator);

        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
    }

    public function __invoke(Request $request)
    {
        $workshop = $this->deserializeRequestContent($request, Workshop::class);

        $this->entityManager->persist($workshop);
        $this->entityManager->flush();

        $response = $this->createApiResponse($request, $workshop, Response::HTTP_CREATED);
        $response->headers->set('Location', $this->urlGenerator->generate('read_workshop', ['id' => $workshop->getId()]));

        return $response;
    }
}
