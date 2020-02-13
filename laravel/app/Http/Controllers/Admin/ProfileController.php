<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends AdminController
{
    protected $section_name = 'Профиль пользователя';

    public function index() {
        $user = Auth::user();

        View::share('page_name', $user->name);

        return view('admin.profile', [
            'user' => $user
        ]);
    }

    public function update(Request $request) {

        $user = Auth::user();



        $data = $request->all();

        // Проверяем валидность данных
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Проверяем пароль, если он есть обновляем

        if (!empty($data['password'])) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6'
            ]);

            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);



        flash()->success('Данные пользователя успешно были обновлены');

        return redirect()->back();
    }
}
