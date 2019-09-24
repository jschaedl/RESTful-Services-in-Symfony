<?php

declare(strict_types=1);

namespace App\Controller\Workshop;

use App\Controller\ApiController;
use App\Entity\Attendee;
use App\Entity\Workshop;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/workshops/{id}/attendees/remove/{attendee_id}", name="remove_attendee_from_workshop", methods={"POST"}, format="json")
 * @ParamConverter("attendee", options={"id": "attendee_id"})
 */
class RemoveAttendeeFromWorkshopController extends ApiController
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

    public function __invoke(Request $request, Workshop $workshop, Attendee $attendee)
    {
        $workshop->removeAttendee($attendee);

        $this->entityManager->flush();

        return $this->createApiResponse($request, null, Response::HTTP_NO_CONTENT);
    }
}
