<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    protected $section_name = '';
    protected $permission = '';

    public function __construct()
    {
        $this->checkPermissions($this->permission);

        View::share('section_name', $this->section_name);
        View::share('page_name', '');
    }

    protected function checkPermissions($permission)
    {
        $this->middleware(function ($request, $next) use ($permission) {
            if (!$permission) return $next($request);

            $user = Auth::user();

            if (!$user) {
                Log::debug('Не залогинен');
                abort('404');
            }

             if(!$user->hasPermission($permission)) {
                Log::debug('Залогинен но без прав');
                abort('404');
            }

            return $next($request);
        });
    }
}
