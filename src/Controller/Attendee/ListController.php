<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Entity\Attendee;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attendees", name="list_attendees", methods={"GET"})
 */
class ListController
{
    private $attendeeRepository;

    public function __construct(AttendeeRepository $attendeeRepository)
    {

        $this->attendeeRepository = $attendeeRepository;
    }

    public function __invoke()
    {
        $attendees = $this->attendeeRepository->findAll();

        $attendeesAsArray = array_map(function (Attendee $attendee): array {
            return $attendee->toArray();
        }, $attendees);

        return new Response(json_encode($attendeesAsArray), Response::HTTP_OK, [
            'content-type' => 'application/json'
        ]);
    }
}
