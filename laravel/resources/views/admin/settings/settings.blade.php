@extends('admin.layout')



@section('content')
    <div class="content_block">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Общие настройки</li>
            </ol>
        </nav>

        {!! Form::open(['route' => ['admin.settings.save'], 'class' => 'form-horizontal']) !!}

        @foreach ($settings_structure as $settings)
            <div class="form-group">
                {!! Form::label($settings['key'], $settings['label'], ['class' => 'control-label']) !!}

                @include('admin.settings.inputs.' . $settings['input'] ?? 'text', ['key' => $settings['key']])
            </div>
        @endforeach



        <p>
            <a href="{{ route('admin.index') }}" class="btn btn-danger">
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

@section('scripts')
    {{-- @include('admin.partials.load_ace') --}}
@endsection
