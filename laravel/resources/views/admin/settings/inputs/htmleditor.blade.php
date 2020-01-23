<div class="col-md-10">
    {!! Form::textarea("settings[{$key}]", settings($key), ['class' => 'form-control htmleditor', 'id' => $key, 'data-ace_wrapper' => $key . '-ace_wrapper']) !!}

    <div id="{{ $key . '-ace_wrapper' }}" class="aceeditor"></div>
</div>
