@extends('admin.layout')

@section('content')
    <div class="content_block">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $section_name }}</li>
            </ol>
        </nav>
    </div>

    @isset($users)
        <div class="content_block">
            <h3>Пользователи</h3>
            @include('admin.user.list_rows')
        </div>
    @endisset
@endsection
