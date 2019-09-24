<?php

declare(strict_types=1);

namespace App\Controller\Workshop;

use App\Controller\ApiController;
use App\Entity\Workshop;
use App\Repository\WorkshopRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/workshops", name="list_workshops", methods={"GET"})
 */
class ListController extends ApiController
{
    private $workshopRepository;

    public function __construct(SerializerInterface $serializer, WorkshopRepository $workshopRepository)
    {
        parent::__construct($serializer);

        $this->workshopRepository = $workshopRepository;
    }

    public function __invoke()
    {
        $allWorkshops = $this->workshopRepository->findAll();

        return $this->createApiResponse($allWorkshops, Response::HTTP_OK);
    }
}
