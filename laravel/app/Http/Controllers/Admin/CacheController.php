<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use View;
use Cache;
use Artisan;

class CacheController extends AdminController
{
    protected $section_name = 'Кеширование';
    protected $permission = 'cache';

    function clear() {
        CacheController::clear_cache();

        return redirect()->back();
    }

    public static function clear_cache()
    {
        Cache::flush();
        Artisan::call('view:clear');

        flash('Кеш успешно очищен', 'success');
    }
}
