<?php

namespace Firith\Imagine\Utility;

use Firith\Imagine\Contracts\ResolverInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class ImagineUtility
{
    public static function format(string $path, array $preset): string
    {
        if ($preset['format']) {
            return $preset['format'];
        }

        return pathinfo($path, PATHINFO_EXTENSION);
    }

    public static function storedFilename(string $path, string $presetName): string
    {
        $extension = self::format(
            $path,
            self::preset($presetName)
        );

        $info = pathinfo($path);

        return sprintf("%s/%s.%s", $info['dirname'], $info['filename'], $extension,);
    }

    public static function preset($name): array
    {
        $presets = App::make('config')->get('imagine.presets');

        if (! Arr::has($presets, $name)) {
            throw new \InvalidArgumentException('Preset not found: ' . $name);
        }

        $preset = Arr::get($presets, $name);
        $preset += App::make('config')->get('imagine.default_preset_settings');

        return $preset;
    }

    public static function url(string $path, string $preset)
    {
        $resolver = App::make(ResolverInterface::class);

        if ($resolver->isStored($path, $preset)) {
            return $resolver->resolve($path, $preset);
        }

        return App::make('url')->route('firith_imagine', [
            'preset' => $preset,
            'path' => $path
        ]);
    }
}
