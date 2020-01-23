@if ($pages->count())
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
            @foreach ($pages as $page)
                <tr class="row_middle">
                    <th scope="row">{{ $page->id }}</th>
                    <td>
                        <img src="{{ url(resize($page->image, 60, 60)) }}" alt="" class="avatar" width="60">
                    </td>
                    <td>{{ $page->name }}</td>
                    <td class="text-center"><i class="fa fa-{{ $page->is_published ? 'check text-success' : 'times text-danger' }}"></td>
                    <td>{!! $page->created_at ? nl2br($page->created_at->format("Y-m-d \n H:i:s")) : '' !!}</td>
                    <td>{!! $page->updated_at ? nl2br($page->updated_at->format("Y-m-d \n H:i:s")) : '' !!}</td>
                    <td>{!! $page->published_at ? nl2br($page->published_at->format("Y-m-d \n H:i:s")) : '' !!}</td>
                    <td class="controls text-right" width="200">
                        <a href="{{ route('admin.blog.edit', $page->id) }}" class="btn btn-primary">
                            <i class="icon fas fa-pencil-alt"></i>
                        </a>

                        {!! Form::open(['route' => ['admin.blog.destroy', $page->id], 'method' => 'DELETE', 'class' => 'inline-block']) !!}
                            <button type="submit" class="btn delete btn-danger">
                                <span class="fas fa-times"></span>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $pages->render() !!}
@endif
