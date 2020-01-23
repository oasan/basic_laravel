@if ($users->count())
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Дата регистрации</th>
                <th scope="col">Дата изменения</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="row_middle">
                    <th scope="row">{{ $user->id }}</th>
                    <td>
                        <img src="{{ url(resize($user->avatar, 60, 60)) }}" alt="" class="avatar circle" width="60">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{!! $user->created_at ? nl2br($user->created_at->format("Y-m-d \n H:i:s")) : '' !!}</td>
                    <td>{!! $user->updated_at ? nl2br($user->updated_at->format("Y-m-d \n H:i:s")) : '' !!}</td>
                    <td class="controls text-right" width="200">
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary">
                            <i class="icon fas fa-pencil-alt"></i>
                        </a>

                        {!! Form::open(['route' => ['admin.user.destroy', $user->id], 'method' => 'DELETE', 'class' => 'inline-block']) !!}
                            <button type="submit" class="btn delete btn-danger">
                                <span class="fas fa-times"></span>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $users->render() !!}
@endif
