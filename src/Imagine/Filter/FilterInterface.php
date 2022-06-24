<?php

namespace Firith\Imagine\Imagine\Filter;

interface FilterInterface
{
    public function type(): string;

    public function config(array $config): self;

    public function imagineFilter(): \Imagine\Filter\FilterInterface;
}
