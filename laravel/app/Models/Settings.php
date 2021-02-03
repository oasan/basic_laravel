<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Settings extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value'
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public static $settings_structure = [
        [
            'key'   => 'test',
            'label' => 'Тестовое поле',
            'input' => 'text'
        ],
    ];

    public static function getByKey($key, $default = null)
    {
        $settings = Cache::rememberForever($key, function() use ($key) {
            return \App\Models\Settings::where('key', $key)->first();
        });

        if (!$settings) return $default;

        return $settings->value;
    }
}
