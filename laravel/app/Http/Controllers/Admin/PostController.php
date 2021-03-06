<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\View;

class PostController extends AdminController
{
    protected $section_name = 'Записи блога';
    protected $permission = 'blog';


    public function index()
    {
        View::share('page_name', 'Список записей');

        $posts = Post::paginate();

        return view('admin.post.list', compact('posts'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'name');
        $tags = Tag::pluck('name', 'name');

        View::share('page_name', 'Добавление новой записи');

        return view('admin.post.form', compact('categories', 'tags'));
    }


    public function store(PostStore $request)
    {
        $data = $request->all();
        $post = Post::create($data);

        $post->slug()->create(['slug' => $request->get('slug')]);
        $post->updateCategories($request->get('categories', []));
        $post->updateTags($request->get('tags', []));

        flash()->success('Запись успешно добавлена');

        return redirect(route('admin.post.edit', $post));
    }

    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'name');
        $tags = Tag::pluck('name', 'name');

        View::share('page_name', 'Редактирование записи');

        return view('admin.post.form', compact('post', 'categories', 'tags'));
    }

    public function update(PostUpdate $request, Post $post)
    {
        $data = $request->all();
        $post->update($data);

        $post->slug()->update(['slug' => $request->get('slug')]);
        $post->updateCategories($request->get('categories', []));
        $post->updateTags($request->get('tags', []));

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
