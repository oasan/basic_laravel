@if ($tags->count())
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
            @foreach ($tags as $tag)
                <tr class="row_middle">
                    <th scope="row">{{ $tag->id }}</th>
                    <td>
                        <img src="{{ url(resize($tag->image, 60, 60)) }}" alt="" class="avatar" width="60">
                    </td>
                    <td>{{ $tag->name }}</td>
                    <td class="text-center"><i class="fa fa-{{ $tag->is_published ? 'check text-success' : 'times text-danger' }}"></td>
                    <td>{!! $tag->created_at ? nl2br($tag->created_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td>{!! $tag->updated_at ? nl2br($tag->updated_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td>{!! $tag->published_at ? nl2br($tag->published_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td class="controls text-right" width="200">
                        <a href="{{ route('admin.tag.edit', $tag->id) }}" class="btn btn-primary">
                            <i class="icon fas fa-pencil-alt"></i>
                        </a>

                        {!! Form::open(['route' => ['admin.tag.destroy', $tag->id], 'method' => 'DELETE', 'class' => 'inline-block']) !!}
                            <button type="submit" class="btn delete btn-danger">
                                <span class="fas fa-times"></span>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $tags->render() !!}
@endif
