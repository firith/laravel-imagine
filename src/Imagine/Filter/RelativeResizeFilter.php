<?php

namespace Firith\Imagine\Imagine\Filter;

use Imagine\Filter\Advanced\RelativeResize;
use Imagine\Image\Box;

class RelativeResizeFilter extends AbstractFilter
{
    public function imagineFilter(): \Imagine\Filter\FilterInterface
    {
        $key = array_key_first($this->config);
        $value = $this->config[$key];

        return new RelativeResize($key, $value);
    }

    public function type(): string
    {
        return 'relative_resize';
    }
}
