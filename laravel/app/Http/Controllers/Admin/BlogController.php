<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Url;
use App\Helpers\Template;
use Illuminate\Support\Facades\View;

class BlogController extends AdminController
{
    public function __construct()
    {
        $this->checkPermissions('blog');

        View::share('section_name', 'Блог');
        View::share('page_name', '');
    }

    public function index()
    {
        View::share('page_name', 'Список записей');

        $pages = Blog::paginate();

        return view('admin.blog.list', compact('pages'));
    }

    public function create()
    {
        View::share('page_name', 'Добавление новой записи');

        return view('admin.blog.form');
    }


    public function store(Request $request)
    {
        // Проверяем валидность данных
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();

        if (empty($data['alias'])) {
            $data['alias'] = $data['name'];
        }

        $blog = Blog::create($data);

        flash()->success('Запись успешно добавлена');

        return redirect(route('admin.blog.edit', $blog));
    }

    public function edit(Blog $blog)
    {
        View::share('page_name', 'Редактирование записи');

        return view('admin.blog.form', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        // Проверяем валидность данных
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();

        if (empty($data['alias'])) {
            $data['alias'] = $data['name'];
        }

        $blog->update($data);

        flash()->success('Запись успешно обновлена');

        return redirect(route('admin.blog.edit', $blog));
    }


    public function destroy(Blog $blog)
    {
        $blog->urlable()->delete();
        $blog->delete();

        flash('Запись успешно удалена', 'success');

        return redirect(route('admin.blog.index'));
    }
}
