<?php

namespace Firith\Imagine\Imagine\Loaders;

use Illuminate\Contracts\Foundation\Application;

class LoaderFactory implements LoaderFactoryInterface
{

    public function build(Application $app): LoaderInterface
    {
        $type = $app->get('config')->get('imagine.loaders.default.type');

        return match ($type) {
            StorageLoader::type() => new StorageLoader(
                $app->get('config')->get('imagine.loaders.default.config')
            ),
            default => throw new \InvalidArgumentException('Loader not found: ' . $type),
        };
    }
}
