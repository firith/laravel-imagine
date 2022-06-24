<?php

namespace Firith\Imagine\Imagine\Resolvers;

use Firith\Imagine\Contracts\ResolverInterface;
use Illuminate\Contracts\Foundation\Application;

interface ResolverFactoryInterface
{
    public function build(Application $app): ResolverInterface;
}
