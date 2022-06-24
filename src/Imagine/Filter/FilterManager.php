<?php

namespace Firith\Imagine\Imagine\Filter;

use Illuminate\Support\Collection;

class FilterManager
{
    protected Collection $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = Collection::wrap($filters);
    }

    public function make(string $type, array $config): FilterInterface
    {
        try {
        return optional($this->filters
            ->firstOrFail(fn(FilterInterface $filter) => $filter->type() === $type))
            ->config($config);
        } catch(\Throwable $exception) {
            throw new \InvalidArgumentException('Filter not found: ' . $type);
        }
    }

}
