<?php

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting(string $key, string $default = ''): string
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::pluck('value', 'key')->toArray();
        });
        return $settings[$key] ?? $default;
    }
}
