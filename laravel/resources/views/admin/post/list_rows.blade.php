@if ($posts->count())
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Название</th>
                <th scope="col">Опубликовано</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата изменения</th>
                <th scope="col">Дата публикации</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="row_middle">
                    <th scope="row">{{ $post->id }}</th>
                    <td>
                        <img src="{{ url(resize($post->image, 60, 60)) }}" alt="" class="avatar" width="60">
                    </td>
                    <td>{{ $post->name }}</td>
                    <td class="text-center"><i class="fa fa-{{ $post->is_published ? 'check text-success' : 'times text-danger' }}"></td>
                    <td>{!! $post->created_at ? nl2br($post->created_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td>{!! $post->updated_at ? nl2br($post->updated_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td>{!! $post->published_at ? nl2br($post->published_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td class="controls text-right" width="200">
                        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-primary">
                            <i class="icon fas fa-pencil-alt"></i>
                        </a>

                        {!! Form::open(['route' => ['admin.post.destroy', $post->id], 'method' => 'DELETE', 'class' => 'inline-block']) !!}
                            <button type="submit" class="btn delete btn-danger">
                                <span class="fas fa-times"></span>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $posts->render() !!}
@endif
