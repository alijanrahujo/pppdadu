<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = self::query()->where('key', $key)->first();

        if ($setting === null || $setting->value === null) {
            return $default;
        }

        if ($setting->type === 'json') {
            $decoded = json_decode($setting->value, true);

            return json_last_error() === JSON_ERROR_NONE ? $decoded : $default;
        }

        return $setting->value;
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): self
    {
        if ($type === 'json' && ! is_string($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

        return self::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
            ]
        );
    }

    /**
     * Get all settings in a specific group as key => value associative array.
     *
     * @return array<string, mixed>
     */
    public static function getGroup(string $group): array
    {
        $settings = self::query()->where('group', $group)->get();
        $result = [];

        foreach ($settings as $setting) {
            if ($setting->type === 'json') {
                $decoded = json_decode($setting->value ?? '', true);
                $result[$setting->key] = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
            } else {
                $result[$setting->key] = $setting->value;
            }
        }

        return $result;
    }
}
