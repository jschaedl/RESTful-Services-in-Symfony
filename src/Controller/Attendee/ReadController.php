<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Controller\ApiController;
use App\Entity\Attendee;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/attendees/{id}", name="read_attendee", methods={"GET"})
 */
class ReadController extends ApiController
{
    private $attendeeRepository;

    public function __construct(
        AttendeeRepository $attendeeRepository,
        SerializerInterface $serializer
    ) {
        parent::__construct($serializer);

        $this->attendeeRepository = $attendeeRepository;
    }

    public function __invoke(Attendee $attendee)
    {
        return $this->createApiResponse(
            $attendee,
            Response::HTTP_OK
        );
    }
}
