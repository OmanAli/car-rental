<?php

use App\Models\SiteSetting;

if (!function_exists('setting')) {
    /**
     * Editable site content: saved value or catalog default (config/site_content.php).
     */
    function setting(string $key, ?string $default = null): ?string
    {
        return SiteSetting::getValue($key, $default);
    }
}

if (!function_exists('setting_image')) {
    /**
     * Public URL for an image setting (uploaded file or default asset path).
     */
    function setting_image(string $key, ?string $default = null): string
    {
        return asset(setting($key, $default) ?? '');
    }
}
