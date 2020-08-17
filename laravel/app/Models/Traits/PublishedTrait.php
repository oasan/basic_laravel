<?php


namespace App\Models\Traits;


use Carbon\Carbon;

trait PublishedTrait
{
    public function getIsPublishedAttribute()
    {
        if (!$this->published) return false;

        if ($this->published_at > Carbon::now()) return false;

        return true;
    }
}
