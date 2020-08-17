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

    /**
     * Категории
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Теги
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Обновляет категории
     * @param $tags
     * @return $this
     */
    public function updateCategories($categories) {
        $this->categories()->detach();

        if (!$categories) {
            return $this;
        }

        foreach ($categories as $category) {
            $category = Category::firstOrNew(['name' => $category]);
            $category->save();

            $this->categories()->attach($category);
        }

        return $this;
    }

    /**
     * Обновляет теги
     * @param $tags
     * @return $this
     */
    public function updateTags($tags) {
        $this->tags()->detach();

        if (!$tags) {
            return $this;
        }

        foreach ($tags as $tag) {
            $tag = Tag::firstOrNew(['name' => $tag]);
            $tag->save();

            $this->tags()->attach($tag);
        }

        return $this;
    }
}
