<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $table = 'site_settings';
    protected $fillable = ['key', 'value'];

    /**
     * All saved settings as [key => value], cached until changed.
     */
    public static function allValues(): array
    {
        return Cache::rememberForever('site_settings', function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Saved value for a key, falling back to the catalog default.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        $value = static::allValues()[$key] ?? null;

        if ($value !== null && $value !== '') {
            return $value;
        }

        return $default ?? static::defaults()[$key] ?? null;
    }

    /**
     * Flat [key => default] map built from the site content catalog.
     */
    public static function defaults(): array
    {
        static $defaults = null;

        if ($defaults === null) {
            $defaults = [];
            foreach (config('site_content.pages', []) as $page) {
                foreach ($page['sections'] as $section) {
                    foreach ($section['fields'] as $key => $field) {
                        $defaults[$key] = $field['default'] ?? null;
                    }
                }
            }
        }

        return $defaults;
    }

    public static function flushCache(): void
    {
        Cache::forget('site_settings');
    }
}
