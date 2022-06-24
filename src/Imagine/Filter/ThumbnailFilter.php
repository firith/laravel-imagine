<?php

namespace Firith\Imagine\Imagine\Filter;

use Imagine\Filter\Basic\Thumbnail;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class ThumbnailFilter extends AbstractFilter
{
    public function imagineFilter(): \Imagine\Filter\FilterInterface
    {
        $settings = ImageInterface::THUMBNAIL_INSET;
        if ($this->config['mode'] === 'outbound') {
            $settings = ImageInterface::THUMBNAIL_OUTBOUND;
        }

        return new Thumbnail(
            size: new Box($this->config['size'][0], $this->config['size'][1]),
            settings: $settings
        );
    }

    public function type(): string
    {
        return 'thumbnail';
    }
}
