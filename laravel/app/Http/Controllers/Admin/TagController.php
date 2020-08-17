<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagStore;
use App\Http\Requests\TagUpdate;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TagController extends AdminController
{
    protected $section_name = 'Теги';
    protected $permission = 'blog';

    public function index()
    {
        View::share('page_name', 'Список тегов');

        $tags = Tag::paginate();

        return view('admin.tag.list', compact('tags'));
    }

    public function create()
    {
        View::share('page_name', 'Добавление нового тега');

        return view('admin.tag.form');
    }

    public function store(TagStore $request)
    {
        $data = $request->all();
        $tag = Tag::create($data);

        $tag->slug()->create(['slug' => $request->get('slug')]);

        flash()->success('Тег успешно добавлен');

        return redirect(route('admin.tag.edit', $tag));
    }

    public function edit(Tag $tag)
    {
        View::share('page_name', 'Редактирование тега');

        return view('admin.tag.form', compact('tag'));
    }

    public function update(TagUpdate $request, Tag $tag)
    {
        $data = $request->all();
        $tag->update($data);

        $tag->slug()->update(['slug' => $request->get('slug')]);

        flash()->success('Тег успешно обновлен');

        return redirect(route('admin.tag.edit', $tag));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        flash('Тег успешно удален', 'success');

        return redirect(route('admin.tag.index'));
    }
}
