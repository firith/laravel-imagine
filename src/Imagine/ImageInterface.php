<?php

namespace Firith\Imagine\Imagine;

interface ImageInterface
{
    public function __construct(string $binary);
    public function binaryContent(): string;
}
