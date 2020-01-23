<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
