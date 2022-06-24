<?php

namespace Firith\Imagine;

use Firith\Imagine\Contracts\ResolverInterface;
use Firith\Imagine\Imagine\Filter\FilterManager;
use Firith\Imagine\Imagine\Filter\RelativeResizeFilter;
use Firith\Imagine\Imagine\Filter\ThumbnailFilter;
use Firith\Imagine\Imagine\Loaders\LoaderFactory;
use Firith\Imagine\Imagine\Loaders\LoaderFactoryInterface;
use Firith\Imagine\Imagine\Loaders\LoaderInterface;
use Firith\Imagine\Imagine\Resolvers\ResolverFactory;
use Firith\Imagine\Imagine\Resolvers\ResolverFactoryInterface;
use Illuminate\Support\ServiceProvider;

class ImagineServiceProvider extends ServiceProvider
{
    protected array $filters = [
        ThumbnailFilter::class,
        RelativeResizeFilter::class,
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'imagine');

        $this->app->bind(ResolverFactoryInterface::class, ResolverFactory::class);

        $this->app->bind(ResolverInterface::class, function ($app) {
            return $app->make(ResolverFactoryInterface::class)
                ->build($app);
        });

        $this->app->bind(LoaderFactoryInterface::class, LoaderFactory::class);

        $this->app->bind(LoaderInterface::class, function ($app) {
            return $app->make(LoaderFactoryInterface::class)
                ->build($app);
        });

        $this->app->tag($this->filters, 'imagine-filter');

        $this->app->when(FilterManager::class)
            ->needs('$filters')
            ->giveTagged('imagine-filter');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('imagine.php'),
            ], ['config', 'imagine-config']);

        }
    }
}
