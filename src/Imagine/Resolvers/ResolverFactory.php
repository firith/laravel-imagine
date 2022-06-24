<?php

namespace Firith\Imagine\Imagine\Resolvers;

use Firith\Imagine\Contracts\ResolverInterface;
use Illuminate\Contracts\Foundation\Application;

class ResolverFactory implements ResolverFactoryInterface
{
    public function build(Application $app): ResolverInterface
    {
        $type = $app->get('config')->get('imagine.resolvers.default.type');

        return match ($type) {
            StorageResolver::type() => new StorageResolver(
                $app->get('config')->get('imagine.resolvers.default.config')
            ),
            default => throw new \InvalidArgumentException('Resolver not found: ' . $type),
        };
    }
}
