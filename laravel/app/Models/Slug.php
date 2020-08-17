<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $fillable = [
        'slug',
        'sluggable_id',
        'sluggable_type'
    ];

    public $timestamps = false;

    /**
     * Получить связанную модель
     */
    public function sluggable()
    {
        return $this->morphTo();
    }

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = self::str_slug($slug);
    }

    public static function str_slug($slug) {
        $parts = explode('/', $slug);

        $parts = array_map('str_slug', $parts);

        return implode('/', $parts);
    }
}
