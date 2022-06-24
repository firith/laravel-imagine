<?php

if (!function_exists('imagine_use_preset')) {
    function imagine_use_preset($path, $preset) {
        return \Firith\Imagine\Utility\ImagineUtility::url($path, $preset);
    }
}
