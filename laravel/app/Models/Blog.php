<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Blog extends Model
{
    protected $table = 'blog';
    protected $fillable = [
        'name',
        'alias',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'introtext',
        'content',
        'image',
        'published',
        'published_at',
    ];

    protected $dates = ['published_at'];

    public function getIsPublishedAttribute()
    {
        if (!$this->published) return false;

        if ($this->published_at > Carbon::now()) return false;

        return true;
    }

    public function setAliasAttribute($alias)
    {
        $this->attributes['alias'] = str_slug($alias);
    }

    public function setImageAttribute($image) {
        if (isset($this->attributes['image'])) {
            deleteUploadedImage($this->attributes['image']);
        }

        $this->attributes['image'] = saveUploadedImage($image, $this->name);
    }

    public function delete()
    {
        deleteUploadedImage($this->image);

        parent::delete();
    }
}
