<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Controller\ApiController;
use App\Pagination\PaginationFactory;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/attendees", name="list_attendees", methods={"GET"}, format="json")
 */
class ListController extends ApiController
{
    private $attendeeRepository;
    private $paginationFactory;

    public function __construct(
        AttendeeRepository $attendeeRepository,
        SerializerInterface $serializer,
        PaginationFactory $paginationFactory
    ) {
        parent::__construct($serializer);

        $this->attendeeRepository = $attendeeRepository;
        $this->paginationFactory = $paginationFactory;
    }

    public function __invoke(Request $request)
    {
        $collection = $this->paginationFactory->createCollection(
            $this->attendeeRepository->getQueryBuilder(),
            $request->query->getInt('page', 1),
            $request->query->getInt('size', 10),
            'list_attendees'
        );

        return $this->createApiResponse($request, $collection, Response::HTTP_OK);
    }
}
