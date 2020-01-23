<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class UserController extends AdminController
{
    public function __construct()
    {
        $this->checkPermissions('user');

        View::share('section_name', 'Пользователи');
        View::share('page_name', '');
    }


    public function index()
    {
        View::share('page_name', 'Список');

        $users = User::orderBy('name')->paginate();

        return view('admin.user.list', compact('users'));
    }

    public function create()
    {
        View::share('page_name', 'Добавление нового пользователя');

        $roles = Role::orderBy('name')->pluck('name', 'id');

        return view('admin.user.form', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Проверяем валидность данных
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $data['password'] = bcrypt($data['password']);

        // Создаем пользователя
        $user = User::create($data);

        $user->roles()->sync($data['role_id']);

        flash()->success('Пользователь успешно добавлен');

        return redirect(route('admin.user.edit', $user->id));
    }


    public function edit($id)
    {
        View::share('page_name', 'Обновление данных пользователя');

        $user = User::findOrFail($id);

        $roles = Role::orderBy('name')->pluck('name', 'id');

        return view('admin.user.form', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

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

        $user->roles()->sync($data['role_id']);

        flash('Данные пользователя успешно обновлены', 'success');

        return redirect(route('admin.user.edit', $user->id));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user) {

            if ($user->avatar) {

                $image = trim($user->avatar, '/');
                if (is_file($image)) {
                    unlink($image);
                }
            }

            $user->delete();
        }

        flash('Пользователь успешно удален из системы', 'success');

        return redirect(route('admin.user.index'));
    }

    public function ban(User $user)
    {
        $user->banned_until = now();
        $user->save();

        flash('Пользователь успешно заблокирован', 'success');

        return redirect(route('admin.user.index'));
    }

    public function unlock(User $user)
    {
        $user->banned_until = null;
        $user->save();

        flash('Пользователь успешно разблокирован', 'success');

        return redirect(route('admin.user.index'));
    }

    public function login(User $user)
    {
        Auth::login($user, true);

        return redirect(route('user.index'));
    }
}
