@extends('admin.layout')

@section('content')
    <div class="content_block">

        <a href="{{ route('admin.category.create') }}" class="float-right btn btn-success add-item-btn"><i class="fa fa-plus"></i> Добавить категорию</a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $section_name }}</li>
            </ol>
        </nav>

        @include('admin.category.list_rows')
    </div>
@endsection
