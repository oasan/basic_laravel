@extends('admin.layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Пользователи</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
        </ol>
    </nav>

    <div class="content_block">
            @if (!empty($user))
                {!! Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::open(['route' => 'admin.user.store', 'enctype' => 'multipart/form-data']) !!}
            @endif
                <div class="form-group{{ $errors->has('name') ? ' has-error' :'' }}">
                    <label for="name">ФИО</label>
                    {{ Form::text('name', empty($user) ? null : $user->name, ['class' => 'form-control', 'id' => 'name']) }}
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' :'' }}">
                    <label for="email">Email</label>
                    {{ Form::email('email', empty($user) ? null : $user->email, ['class' => 'form-control', 'id' => 'email']) }}
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Пароль', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {!! Form::label('password_confirmation', 'Подтверждение пароля', ['class' => 'control-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>



                <div class="form-group">
                    {!! Form::label('avatar', 'Фото', ['class' => 'control-label']) !!}
                    {!! Form::file('avatar', ['class' => 'form-control']) !!}

                    @if (!empty($user) && !empty($user->avatar))
                        <br>
                        <img src="{{ url($user->avatar) }}" alt="Фото" class="preview_image" width="200">
                    @endif
                </div>

                <div class="form-group">
                    <label for="role_id">Тип пользователя</label>
                    {{ Form::select('role_id[]', $roles, !empty($user) && $user->roles ? $user->roles->pluck('id') : [2], ['class' => 'form-control multiple_select', 'id' => 'role_id', 'multiple' => true]) }}
                </div>


                <div class="form-group">
                    <h4>Права пользователя</h4>

                    @foreach (App\Models\User::PERMISSIONS as $permission => $permission_name)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission }}"
                                id="permissions_{{ $permission }}"
                                {{ !empty($user) && $user->hasPermission($permission) ? 'checked' : '' }}>

                            <label class="form-check-label" for="permissions_{{ $permission }}">
                                {{ $permission_name }}
                            </label>
                        </div>
                    @endforeach
                </div>






                <p>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-danger">
                        <i class="fa fa-undo"></i>
                        Отмена
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Сохранить
                    </button>
                </p>
            {!! Form::close() !!}
    </div>
@endsection
