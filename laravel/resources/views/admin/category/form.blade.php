@extends('admin.layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">{{ $section_name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
        </ol>
    </nav>

    <div class="content_block">
        @if (!empty($category))
            {!! Form::model($category, ['route' => ['admin.category.update', $category->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
        @else
            {!! Form::open(['route' => 'admin.category.store', 'enctype' => 'multipart/form-data']) !!}
        @endif
            <div class="form-group{{ $errors->has('name') ? ' has-error' :'' }}">
                <label for="name">Название страницы</label>
                {{ Form::text('name', empty($category) ? null : $category->name, ['class' => 'form-control', 'id' => 'name']) }}
            </div>


            <div class="form-group">
                <label for="slug">Псевдоним</label>
                {{ Form::text('slug', empty($category) ? null : $category->url, ['class' => 'form-control', 'id' => 'slug']) }}
            </div>


            <div class="form-group">
                <label for="meta_title">Title</label>
                {{ Form::text('meta_title', empty($category) ? null : $category->meta_title, ['class' => 'form-control', 'id' => 'meta_title']) }}
            </div>


            <div class="form-group">
                <label for="meta_description">Description</label>
                {{ Form::text('meta_description', empty($category) ? null : $category->meta_description, ['class' => 'form-control', 'id' => 'meta_description']) }}
            </div>


            <div class="form-group">
                <label for="meta_keywords">Keywords</label>
                {{ Form::text('meta_keywords', empty($category) ? null : $category->meta_keywords, ['class' => 'form-control', 'id' => 'meta_keywords']) }}
            </div>


            <div class="form-group">
                <label for="introtext">Описание</label>
                {{ Form::textarea('introtext', empty($category) ? null : $category->introtext, ['class' => 'form-control', 'id' => 'introtext', 'rows' => 3]) }}
            </div>


            <div class="form-group">
                <label for="content">Текст страницы</label>
                {{ Form::textarea('content', empty($category) ? null : $category->content, ['class' => 'form-control', 'id' => 'content', 'rows' => 10]) }}
            </div>


            <div class="form-group">
                {!! Form::label('image', 'Изображение', ['class' => 'control-label']) !!}
                {!! Form::file('image', ['class' => 'form-control']) !!}

                @if (!empty($category) && !empty($category->image))
                    <br>
                    <img src="{{ url($category->image) }}" alt="Фото" class="preview_image" width="200">
                @endif
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" value="1" id="published" {{ !empty($category) && $category->published ? 'checked' : '' }}>

                    <label class="form-check-label" for="published">Опубликовано</label>
                </div>
            </div>

            <div class="form-group">
                <label for="published_at">Дата публикации</label>
                {{ Form::text('published_at', empty($category) ? date('Y-m-d H:i:s') : $category->published_at, ['class' => 'form-control', 'id' => 'published_at']) }}
            </div>

            <p>
                <a href="{{ route('admin.category.index') }}" class="btn btn-danger">
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
    @include('admin.partials.editor', ['editor' => '#content'])
@endsection
