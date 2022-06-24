<?php

namespace Firith\Imagine\Imagine\Resolvers;

use Firith\Imagine\Contracts\ResolverInterface;
use Firith\Imagine\Imagine\ImageInterface;
use Firith\Imagine\Utility\ImagineUtility;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class StorageResolver implements ResolverInterface
{
    protected Filesystem $filesystem;

    public function __construct(array $config)
    {
        $this->filesystem = Storage::disk($config['disk']);
    }

    public function isStored(string $path, string $preset): bool
    {
        return $this->filesystem->exists($preset . '/' . ImagineUtility::storedFilename($path, $preset));
    }

    public function resolve(string $path, string $preset): string
    {
        return $this->filesystem->url($preset . '/' . ImagineUtility::storedFilename($path, $preset));
    }

    public function store(ImageInterface $content, string $path, $preset): void
    {
        $this->filesystem->put(
            $preset . '/' . ImagineUtility::storedFilename($path, $preset),
            $content->binaryContent()
        );
    }

    public function remove(array $paths, array $preset): void
    {

    }

    public static function type(): string
    {
        return 'storage';
    }

}
