<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected function checkPermissions($permission)
    {
        $this->middleware(function ($request, $next) use ($permission) {
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
