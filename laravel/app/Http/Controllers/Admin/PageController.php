<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Url;
use App\Helpers\Template;
use View;

class PageController extends AdminController
{
    public function __construct()
    {
        $this->checkPermissions('page');

        View::share('section_name', 'Страницы');
        View::share('page_name', '');
    }

    public function index()
    {
        View::share('page_name', 'Список страниц');

        $pages = Page::paginate();

        return view('admin.page.list', compact('pages'));
    }

    public function create()
    {
        View::share('page_name', 'Добавление новой страницы');

        $templates = Template::getPageTemplatesList();

        return view('admin.page.form', compact('templates'));
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

        $page = Page::create($data);

        $url = new Url();
        $url->urlable()->associate($page);
        $url->url = $page->generateUrl();
        $url->save();

        flash()->success('Страница успешно добавлена');

        return redirect(route('admin.page.edit', $page));
    }

    public function edit(Page $page)
    {
        View::share('page_name', 'Редактирование страницы');

        $templates = Template::getPageTemplatesList();

        return view('admin.page.form', compact('templates', 'page'));
    }

    public function update(Request $request, Page $page)
    {
        // Проверяем валидность данных
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();

        if (empty($data['alias'])) {
            $data['alias'] = $data['name'];
        }

        $page->update($data);


        if($page->urlable) {
            $page->urlable->url = $page->generateUrl();
            $page->urlable->save();
        } else {
            $url = new Url();
            $url->urlable()->associate($page);
            $url->url = $page->generateUrl();
            $url->save();
        }

        flash()->success('Страница успешно обновлена');

        return redirect(route('admin.page.edit', $page));
    }


    public function destroy(Page $page)
    {
        $page->urlable()->delete();
        $page->delete();

        flash('Страница успешно удалена', 'success');

        return redirect(route('admin.page.index'));
    }
}
