<?php

namespace Firith\Imagine\Contracts;

use Firith\Imagine\Imagine\ImageInterface;

interface ResolverInterface
{
    public static function type(): string;

    public function isStored(string $path, string $preset): bool;

    public function resolve(string $path, string $preset): string;

    public function store(ImageInterface $content, string $path, $preset): void;

    public function remove(array $paths, array $preset): void;
}
