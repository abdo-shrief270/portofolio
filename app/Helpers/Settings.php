<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class Settings
{
    protected static array $settings = [];

    public static function get(string $key, mixed $default = null): mixed
    {
        if (empty(self::$settings)) {
            self::loadSettings();
        }

        return self::$settings[$key] ?? $default;
    }

    public static function getGroup(string $group): array
    {
        if (empty(self::$settings)) {
            self::loadSettings();
        }

        return collect(self::$settings)
            ->filter(fn ($value, $key) => str_starts_with($key, $group . '_') || self::getSettingGroup($key) === $group)
            ->toArray();
    }

    protected static function getSettingGroup(string $key): ?string
    {
        return Cache::remember("setting_group_{$key}", 3600, function () use ($key) {
            return Setting::where('key', $key)->value('group');
        });
    }

    protected static function loadSettings(): void
    {
        self::$settings = Cache::remember('site_settings', 3600, function () {
            return Setting::all()
                ->mapWithKeys(function ($setting) {
                    $value = $setting->value;
                    // Get the current locale value if it's an array
                    if (is_array($value)) {
                        $value = $value[app()->getLocale()] ?? $value['en'] ?? reset($value);
                    }
                    return [$setting->key => $value];
                })
                ->toArray();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('site_settings');
        self::$settings = [];
    }
}
