<?php

declare(strict_types=1);

namespace App\Controller\Workshop;

use App\Controller\ApiController;
use App\Entity\Workshop;
use App\Repository\WorkshopRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/workshops/{id}", name="read_workshop", methods={"GET"}, format="json")
 */
class ReadController extends ApiController
{
    private $workshopRepository;

    public function __construct(SerializerInterface $serializer, WorkshopRepository $workshopRepository)
    {
        parent::__construct($serializer);

        $this->workshopRepository = $workshopRepository;
    }

    public function __invoke(Request $request, Workshop $workshop)
    {
        return $this->createApiResponse($request, $workshop, Response::HTTP_OK);
    }
}
