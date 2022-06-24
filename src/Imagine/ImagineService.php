<?php

namespace Firith\Imagine\Imagine;

use Firith\Imagine\Imagine\Filter\FilterInterface;
use Firith\Imagine\Imagine\Filter\FilterManager;
use Firith\Imagine\Imagine\ImageInterface as BinaryContent;
use Firith\Imagine\Utility\ImagineUtility;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Imagine\Image\ImageInterface;

class ImagineService
{
    protected ImageInterface $image;

    public function __construct(protected FilterManager $filterManager)
    {
    }

    public function open($path): self
    {
        $this->image = $this->driver()->open($path);

        return $this;
    }

    public function applyPreset($presetName): BinaryContent
    {
        $preset = ImagineUtility::preset($presetName);

        $transformation = new \Imagine\Filter\Transformation();

        collect(Arr::get($preset, "filters", []))
            ->map(fn($config, $filterKey) => $this->filterManager->make($filterKey, $config))
            ->each(fn(FilterInterface $filter) => $transformation->add($filter->imagineFilter()));

        $this->image = $transformation->apply($this->image);

        return $this->content($preset);
    }

    public function content(array $preset): BinaryContent
    {
        $format = ImagineUtility::format(
            $this->image->metadata()->get('filepath'),
            $preset
        );

        return new Image(
            $this->image->get($format, $preset)
        );
    }

    protected function driver()
    {
        $driver = app('config')->get('imagine.driver');

        return match ($driver) {
            'gd' => new \Imagine\GD\Imagine(),
            'imagick' => new \Imagine\Imagick\Imagine()
        };
    }
}
