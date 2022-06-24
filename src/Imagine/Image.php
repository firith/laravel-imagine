<?php

namespace Firith\Imagine\Imagine;

class Image implements ImageInterface
{

    public function __construct(protected string $binary)
    {
    }

    public function binaryContent(): string
    {
       return $this->binary;
    }
}
