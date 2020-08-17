<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\View;

class PostController extends AdminController
{
    protected $section_name = 'Записи блога';
    protected $permission = 'post';


    public function index()
    {
        View::share('page_name', 'Список записей');

        $posts = Post::paginate();

        return view('admin.post.list', compact('posts'));
    }

    public function create()
    {
        View::share('page_name', 'Добавление новой записи');

        return view('admin.post.form');
    }


    public function store(StorePost $request)
    {
        $data = $request->all();

        if (empty($data['alias'])) {
            $data['alias'] = $data['name'];
        }

        $post = Post::create($data);

        $post->slug()->create(['slug' => $request->get('slug')]);

        flash()->success('Запись успешно добавлена');

        return redirect(route('admin.post.edit', $post));
    }

    public function edit(Post $post)
    {
        View::share('page_name', 'Редактирование записи');

        return view('admin.post.form', compact('post'));
    }

    public function update(UpdatePost $request, Post $post)
    {
        $data = $request->all();

        if (empty($data['alias'])) {
            $data['alias'] = $data['name'];
        }

        $post->update($data);

        flash()->success('Запись успешно обновлена');

        return redirect(route('admin.post.edit', $post));
    }


    public function destroy(Post $post)
    {
        $post->delete();

        flash('Запись успешно удалена', 'success');

        return redirect(route('admin.post.index'));
    }
}
