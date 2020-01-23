@extends('admin.layout')



@section('content')
    <div class="content_block">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Профиль пользователя</li>
            </ol>
        </nav>

        {!! Form::model($user, ['route' => ['admin.profile.update', $user->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Имя пользователя', ['class' => 'control-label col-md-3']) !!}
            <div class="col-md-6">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email', ['class' => 'control-label col-md-3']) !!}
            <div class="col-md-6">
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('avatar', 'Фото', ['class' => 'control-label col-md-3']) !!}

            <div class="col-md-6">
                {!! Form::file('avatar', ['class' => 'form-control']) !!}

                @if (!empty($user) && !empty($user->avatar))
                    <br>
                    <img src="{{ url($user->avatar) }}" alt="Фото" class="preview_image" width="200">
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Пароль', ['class' => 'control-label col-md-3']) !!}
            <div class="col-md-6">
                {!! Form::password('password', ['class' => 'form-control']) !!}
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {!! Form::label('password_confirmation', 'Подтверждение пароля', ['class' => 'control-label col-md-3']) !!}
            <div class="col-md-6">
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="clearfix"></div>

        <br>
        <br>

        <div class="text-right">
            {!! link_to_route('admin.index', 'Отмена', [], ['class' => "btn btn-danger"]) !!}
            <input type="submit" class="btn btn-success" value="Сохранить">
        </div>
    </div>

    {!! Form::close() !!}
@endsection
