<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoryController extends AdminController
{
    protected $section_name = 'Категории';
    protected $permission = 'blog';

    public function index()
    {
        View::share('page_name', 'Список категорий');

        $categories = Category::paginate();

        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        View::share('page_name', 'Добавление новой категории');

        return view('admin.category.form');
    }

    public function store(CategoryStore $request)
    {
        $data = $request->all();
        $category = Category::create($data);

        $category->slug()->create(['slug' => $request->get('slug')]);

        flash()->success('Категория успешно добавлена');

        return redirect(route('admin.category.edit', $category));
    }

    public function edit(Category $category)
    {
        View::share('page_name', 'Редактирование категории');

        return view('admin.category.form', compact('category'));
    }


    public function update(CategoryUpdate $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);

        $category->slug()->update(['slug' => $request->get('slug')]);

        flash()->success('Категория успешно обновлена');

        return redirect(route('admin.category.edit', $category));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        flash('Категория успешно удалена', 'success');

        return redirect(route('admin.category.index'));
    }
}
