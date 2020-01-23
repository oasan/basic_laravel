<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('/assets/css/admin.css') }}">
</head>

<body>
    <div class="main_wrap no-sidebar">
        <div class="top">
            <div class="logo"><a href="{{  url('/') }}">{{ config('app.name') }}</a></div>
            <div class="menu float-right">
                <a href="#top_menu" class="menu_toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <ul id="top_menu" class="text-right">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="content_block full">
            <div class="msg_block">
                @include('flash::message')

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            @yield('content')
        </div>
    </div>

    <script src="{{ mix('/assets/js/admin.js') }}"></script>
    @yield('scripts')
</body>

</html>
