<?php

namespace Firith\Imagine\Imagine\Loaders;

use Illuminate\Contracts\Foundation\Application;

interface LoaderFactoryInterface
{
    public function build(Application $app): LoaderInterface;
}
