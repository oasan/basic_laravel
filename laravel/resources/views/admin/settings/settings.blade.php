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
            <div class="form-group row">
                {!! Form::label($settings['key'], $settings['label'], ['class' => 'control-label col-md-2']) !!}

                @include('admin.settings.inputs.' . $settings['input'] ?? 'text', ['key' => $settings['key']])
            </div>
        @endforeach




        <div class="clearfix"></div>

        <br>
        <br>

        <div class="text-right">
            {!! link_to_route('admin.index', 'Отмена', [], ['class' => "btn btn-danger"]) !!}
            <input type="submit" class="btn btn-success" value="Сохранить">
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    {{-- @include('admin.partials.load_ace') --}}
@endsection
