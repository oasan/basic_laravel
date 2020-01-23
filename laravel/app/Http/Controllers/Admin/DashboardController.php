<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\User;
use View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AdminController
{
    public function __construct()
    {
        View::share('section_name', 'Панель управления');
        View::share('page_name', '');
    }

    public function index()
    {
        if (Auth::user()->hasPermission('user')) {
            $users = User::paginate();
        }

        return view('admin.dashboard', compact('users'));
    }
}
