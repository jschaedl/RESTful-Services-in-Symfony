<?php

declare(strict_types=1);

namespace App\Controller\Workshop;

use App\Controller\ApiController;
use App\Entity\Workshop;
use App\Repository\WorkshopRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/workshops/{id}", name="read_workshop", methods={"GET"}, format="json")
 * @IsGranted("ROLE_USER")
 */
class ReadController extends ApiController
{
    private $workshopRepository;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        WorkshopRepository $workshopRepository
    ) {
        parent::__construct($serializer, $validator);

        $this->workshopRepository = $workshopRepository;
    }

    public function __invoke(Request $request, Workshop $workshop)
    {
        return $this->createApiResponse($request, $workshop, Response::HTTP_OK);
    }
}
