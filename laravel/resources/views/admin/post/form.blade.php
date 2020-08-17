@extends('admin.layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">{{ $section_name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
        </ol>
    </nav>

    <div class="content_block">
        @if (!empty($post))
            {!! Form::model($post, ['route' => ['admin.post.update', $post->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
        @else
            {!! Form::open(['route' => 'admin.post.store', 'enctype' => 'multipart/form-data']) !!}
        @endif
            <div class="form-group{{ $errors->has('name') ? ' has-error' :'' }}">
                <label for="name">Название страницы</label>
                {{ Form::text('name', empty($post) ? null : $post->name, ['class' => 'form-control', 'id' => 'name']) }}
            </div>


            <div class="form-group">
                <label for="slug">Псевдоним</label>
                {{ Form::text('slug', empty($post) ? null : $post->url, ['class' => 'form-control', 'id' => 'slug']) }}
            </div>


            <div class="form-group">
                <label for="meta_title">Title</label>
                {{ Form::text('meta_title', empty($post) ? null : $post->meta_title, ['class' => 'form-control', 'id' => 'meta_title']) }}
            </div>


            <div class="form-group">
                <label for="meta_description">Description</label>
                {{ Form::text('meta_description', empty($post) ? null : $post->meta_description, ['class' => 'form-control', 'id' => 'meta_description']) }}
            </div>


            <div class="form-group">
                <label for="meta_keywords">Keywords</label>
                {{ Form::text('meta_keywords', empty($post) ? null : $post->meta_keywords, ['class' => 'form-control', 'id' => 'meta_keywords']) }}
            </div>


            <div class="form-group">
                <label for="introtext">Описание</label>
                {{ Form::textarea('introtext', empty($post) ? null : $post->introtext, ['class' => 'form-control', 'id' => 'introtext', 'rows' => 3]) }}
            </div>


            <div class="form-group">
                <label for="content">Текст страницы</label>
                {{ Form::textarea('content', empty($post) ? null : $post->content, ['class' => 'form-control', 'id' => 'content', 'rows' => 10]) }}
            </div>


            <div class="form-group">
                {!! Form::label('image', 'Изображение', ['class' => 'control-label']) !!}
                {!! Form::file('image', ['class' => 'form-control']) !!}

                @if (!empty($post) && !empty($post->image))
                    <br>
                    <img src="{{ url($post->image) }}" alt="Фото" class="preview_image" width="200">
                @endif
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" value="1" id="published" {{ !empty($post) && $post->published ? 'checked' : '' }}>

                    <label class="form-check-label" for="published">Опубликовано</label>
                </div>
            </div>

            <div class="form-group">
                <label for="published_at">Дата публикации</label>
                {{ Form::text('published_at', empty($post) ? date('Y-m-d H:i:s') : $post->published_at, ['class' => 'form-control', 'id' => 'published_at']) }}
            </div>

            <p>
                <a href="{{ route('admin.post.index') }}" class="btn btn-danger">
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
