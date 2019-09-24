<?php

declare(strict_types=1);

namespace App\Controller\Workshop;

use App\Entity\Workshop;
use App\Repository\WorkshopRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/workshops", name="list_workshops", methods={"GET"})
 */
class ListController
{
    private $workshopRepository;

    public function __construct(WorkshopRepository $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

    public function __invoke()
    {
        $allWorkshops = $this->workshopRepository->findAll();

        $allWorkshopsAsArray = array_map(function (Workshop $workshop): array {
            return $workshop->toArray();
        }, $allWorkshops);

        return new Response(json_encode($allWorkshopsAsArray), Response::HTTP_OK, [
            'Content-Type' => 'application/json',
        ]);
    }
}
