<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Controller\ApiController;
use App\Entity\Attendee;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/attendees/{id}", name="read_attendee", methods={"GET"}, format="json")
 */
class ReadController extends ApiController
{
    private $attendeeRepository;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        AttendeeRepository $attendeeRepository
    ) {
        parent::__construct($serializer, $validator);

        $this->attendeeRepository = $attendeeRepository;
    }

    public function __invoke(Request $request, Attendee $attendee)
    {
        return $this->createApiResponse($request, $attendee, Response::HTTP_OK);
    }
}
