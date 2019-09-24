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

        $paginatedCollection->addlink('self', $this->urlGenerator->generate($routeName, [
            'page' => $page,
            'size' => $size,
        ]));

        if ($pager->hasNextPage()) {
            $paginatedCollection->addlink('next', $this->urlGenerator->generate($routeName, [
                'page' => $pager->getNextPage(),
                'size' => $size,
            ], UrlGeneratorInterface::ABSOLUTE_URL));
        }

        if ($pager->hasPreviousPage()) {
            $paginatedCollection->addlink('prev', $this->urlGenerator->generate($routeName, [
                'page' => $pager->getPreviousPage(),
                'size' => $size,
            ], UrlGeneratorInterface::ABSOLUTE_URL));
        }

        $paginatedCollection->addlink('first', $this->urlGenerator->generate($routeName, [
            'page' => 1,
            'size' => $size,
        ], UrlGeneratorInterface::ABSOLUTE_URL));

        $paginatedCollection->addlink('last', $this->urlGenerator->generate($routeName, [
            'page' => $pager->getNbPages(),
            'size' => $size,
        ], UrlGeneratorInterface::ABSOLUTE_URL));

        return $paginatedCollection;
    }
}
