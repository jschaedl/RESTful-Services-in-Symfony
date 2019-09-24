<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Entity\Attendee;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attendees/{id}", name="read_attendee", methods={"GET"})
 */
class ReadController
{
    private $attendeeRepository;

    public function __construct(AttendeeRepository $attendeeRepository)
    {
        $this->attendeeRepository = $attendeeRepository;
    }

    public function __invoke(Attendee $attendee)
    {
        return new Response(json_encode($attendee->toArray()), Response::HTTP_OK, [
            'content-type' => 'application/json'
        ]);
    }
}
