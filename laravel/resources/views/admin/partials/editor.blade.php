<script src="/assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    var tinymce_config = {
        selector: '',
        language: 'ru',
        file_picker_callback : elFinderBrowser,
        plugins: ['code', 'image', 'lists'],
        toolbar: 'undo redo | styleselect | removeformat | bold italic underline strikethrough | alignleft aligncenter alignright | bullist numlist | outdent indent | image code',
        menubar: false,
        relative_urls : false,
        remove_script_host : true,
    };

    @if (is_array($editor))
        @foreach ($editor as $selector)
            tinymce_config.selector = '{!! $selector !!}';
            tinymce.init(tinymce_config);
        @endforeach

    @else
        tinymce_config.selector = '{!! $editor !!}';
        tinymce.init(tinymce_config);
    @endif
</script>
