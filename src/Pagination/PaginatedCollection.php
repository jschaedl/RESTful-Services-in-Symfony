<?php

declare(strict_types=1);

namespace App\Pagination;

use Symfony\Component\Serializer\Annotation\SerializedName;

class PaginatedCollection
{
    private $items;
    private $total;
    private $count;

    private $_links;

    public function __construct(array $items, int $total)
    {
        $this->items = $items;
        $this->total = $total;
        $this->count = \count($items);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}