<?php

namespace Firith\Imagine\Imagine\Loaders;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class StorageLoader implements LoaderInterface
{
    protected Filesystem $filesystem;

    public function __construct(array $config)
    {
        $this->filesystem = Storage::disk($config['disk']);
    }

    public function exists($path): bool
    {
        return $this->filesystem->exists($path);
    }

    public function resolve($path): string
    {
        return $this->filesystem->path($path);
    }

    public static function type(): string
    {
        return 'storage';
    }
}
