<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Controller\ApiController;
use App\Entity\Attendee;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/attendees", name="list_attendees", methods={"GET"})
 */
class ListController extends ApiController
{
    private $attendeeRepository;

    public function __construct(
        AttendeeRepository $attendeeRepository,
        SerializerInterface $serializer
    ) {
        parent::__construct($serializer);

        $this->attendeeRepository = $attendeeRepository;
    }

    public function __invoke()
    {
        $attendees = $this->attendeeRepository->findAll();

        return $this->createApiResponse(
            $attendees,
            Response::HTTP_OK
        );
    }
}
