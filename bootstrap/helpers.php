<?php
/**
 * Helpers
 */

if (!function_exists('getActionController')) {
    function getActionController($action)
    {
        return \Illuminate\Support\Arr::last(
            explode('\\', \Illuminate\Support\Arr::first(
                explode('@', $action))));
    }
}