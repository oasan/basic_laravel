<?php

namespace App\Models;

use App\Models\Traits\ImageTrait;
use App\Models\Traits\PublishedTrait;
use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use SluggableTrait;
    use ImageTrait;
    use PublishedTrait;


    protected $fillable = [
        'name',
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

    public function delete()
    {
        $this->deleteImage();
        $this->deleteSlug();

        parent::delete();
    }
}
