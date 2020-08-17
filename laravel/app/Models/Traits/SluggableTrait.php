<?php

namespace App\Models\Traits;

use App\Models\Slug;

trait SluggableTrait {

    /**
     * Удаляет связанный алиас
     */
    protected function deleteSlug() {
        $this->slug()->delete();
    }

    public function slug()
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }

    public function getUrlAttribute() {
        return $this->slug->slug;
    }
}
