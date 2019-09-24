<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Controller\ApiController;
use App\Entity\Attendee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/attendees", name="create_attendee", methods={"POST"}, format="json")
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
        $attendee = $this->deserializeRequestContent($request, Attendee::class);

        $this->entityManager->persist($attendee);
        $this->entityManager->flush();

        $response = $this->createApiResponse($request, $attendee, Response::HTTP_CREATED);
        $response->headers->set('Location', $this->urlGenerator->generate('read_attendee', ['id' => $attendee->getId()]));

        return $response;
    }
}
