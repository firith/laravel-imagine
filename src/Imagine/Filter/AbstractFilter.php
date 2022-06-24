<?php

namespace Firith\Imagine\Imagine\Filter;

abstract class AbstractFilter implements FilterInterface
{
    protected array $config = [];

    public function config(array $config): self
    {
        $this->config = $config;

        return $this;
    }
}
