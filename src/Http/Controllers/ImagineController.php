<?php

namespace Firith\Imagine\Http\Controllers;

use Firith\Imagine\Contracts\ResolverInterface;
use Firith\Imagine\Imagine\Filter\FilterManager;
use Firith\Imagine\Imagine\ImagineService;
use Firith\Imagine\Imagine\Loaders\LoaderInterface;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Redirect;

class ImagineController extends Controller
{
    public function __invoke(
        ResolverInterface $resolver,
        LoaderInterface $loader,
        ImagineService $imagine,
        FilterManager $manager,
        string $preset,
        string $path
    ) {
        if ($resolver->isStored($path, $preset)) {
            return Redirect::to($resolver->resolve($path, $preset));
        }

        if (!$loader->exists($path)) {
            $this->abort(404, 'Source image not found');
        }

        $content = $imagine
            ->open($loader->resolve($path))
            ->applyPreset($preset)
        ;

        $resolver->store($content, $path, $preset);

        return Redirect::to($resolver->resolve($path, $preset));
    }

    public function abort($code, $message)
    {
        Container::getInstance()->abort($code, $message);
    }
}
