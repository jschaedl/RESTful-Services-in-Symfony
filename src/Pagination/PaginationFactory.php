<?php

declare(strict_types=1);

namespace App\Pagination;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaginationFactory
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function createCollection(QueryBuilder $queryBuilder, int $page, int $size, string $routeName = ''): PaginatedCollection
    {
        $pagerAdapter = new DoctrineORMAdapter($queryBuilder);
        $pager = new Pagerfanta($pagerAdapter);

        $pager
            ->setMaxPerPage($size)
            ->setCurrentPage($page)
        ;

        $items = [];
        foreach ($pager->getCurrentPageResults() as $item) {
            $items[] = $item;
        }

        return new PaginatedCollection($items, $pager->getNbResults());
    }
}
