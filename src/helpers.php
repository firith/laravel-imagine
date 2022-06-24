<?php

if (!function_exists('imagine_preset')) {
    function imagine_preset($path, $preset) {
        return \Firith\Imagine\Utility\ImagineUtility::url($path, $preset);
    }
}
