<?php

declare(strict_types=1);

namespace App\Controller\Workshop;

use App\Controller\ApiController;
use App\Pagination\PaginationFactory;
use App\Repository\WorkshopRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/workshops", name="list_workshops", methods={"GET"}, format="json")
 */
class ListController extends ApiController
{
    private $workshopRepository;
    private $paginationFactory;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        WorkshopRepository $workshopRepository,
        PaginationFactory $paginationFactory
    ) {
        parent::__construct($serializer, $validator);

        $this->workshopRepository = $workshopRepository;
        $this->paginationFactory = $paginationFactory;
    }

    public function __invoke(Request $request)
    {
        $collection = $this->paginationFactory->createCollection(
            $this->workshopRepository->getQueryBuilder(),
            $request->query->getInt('page', 1),
            $request->query->getInt('size', 10),
            'list_workshops'
        );

        return $this->createApiResponse($request, $collection, Response::HTTP_OK);
    }
}
