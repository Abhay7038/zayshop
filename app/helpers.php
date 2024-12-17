<?php

if (!function_exists('resource_css_plugin')) {
    function resource_css_plugin($path)
    {
        return url($path);
    }
}
