@if ($categories->count())
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
            @foreach ($categories as $category)
                <tr class="row_middle">
                    <th scope="row">{{ $category->id }}</th>
                    <td>
                        <img src="{{ url(resize($category->image, 60, 60)) }}" alt="" class="avatar" width="60">
                    </td>
                    <td>{{ $category->name }}</td>
                    <td class="text-center"><i class="fa fa-{{ $category->is_published ? 'check text-success' : 'times text-danger' }}"></td>
                    <td>{!! $category->created_at ? nl2br($category->created_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td>{!! $category->updated_at ? nl2br($category->updated_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td>{!! $category->published_at ? nl2br($category->published_at->format("Y-m-d H:i:s")) : '' !!}</td>
                    <td class="controls text-right" width="200">
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">
                            <i class="icon fas fa-pencil-alt"></i>
                        </a>

                        {!! Form::open(['route' => ['admin.category.destroy', $category->id], 'method' => 'DELETE', 'class' => 'inline-block']) !!}
                            <button type="submit" class="btn delete btn-danger">
                                <span class="fas fa-times"></span>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $categories->render() !!}
@endif
