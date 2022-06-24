<?php

namespace Firith\Imagine\Imagine\Loaders;

use Illuminate\Contracts\Foundation\Application;

interface LoaderInterface
{
    public function exists($path): bool;

    public function resolve($path): string;

    public static function type(): string;
}
