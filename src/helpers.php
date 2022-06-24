<?php

if (!function_exists('firith_imagine')) {
    function firith_imagine($path, $preset) {
        return \Firith\Imagine\Utility\ImagineUtility::url($path, $preset);
    }
}
