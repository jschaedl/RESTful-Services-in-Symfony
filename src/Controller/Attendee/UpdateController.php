<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Controller\ApiController;
use App\Entity\Attendee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/attendees/{id}", name="update_attendee", methods={"PUT"}, format="json")
 */
class UpdateController extends ApiController
{
    private $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($serializer, $validator);

        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, Attendee $attendee)
    {
        /** @var Attendee $requestAttendee */
        $requestAttendee = $this->deserializeRequestContent($request, Attendee::class);

        $attendee->updateBy($requestAttendee);

        $this->entityManager->flush();

        return $this->createApiResponse($request, null, Response::HTTP_NO_CONTENT);
    }
}
