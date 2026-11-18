<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Ambil semua pengaturan sebagai array key => value.
     */
    public static function values(): array
    {
        $defaults = config('portfolio.settings', []);

        $stored = static::query()->pluck('value', 'key')->all();

        $values = [];
        foreach ($defaults as $key => $definition) {
            $values[$key] = array_key_exists($key, $stored) ? $stored[$key] : ($definition['default'] ?? '');
        }

        return $values;
    }

    public static function saveValues(array $values): void
    {
        foreach ($values as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
