<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ !empty($page_name) ? $page_name . ' - ' : '' }}{{ $section_name }} | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('/assets/css/admin.css') }}">
</head>

<body {!! !empty($_COOKIE['menu_toggle']) && $_COOKIE['menu_toggle'] == 'hide' ? 'class="collapsed_sidebar"' : '' !!}>
    <div class="sidebar">
        <div class="wrap">
            <div class="top">
                <div class="name">
                    <span>
                        {{ env('APP_NAME') }}
                    </span>
                </div>
            </div>

            <div class="menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link {{ active('admin.index') }}"><i class="icon fas fa-home"></i> <span class="name">Главная</span></a>
                    </li>


                    @if (auth()->user()->hasPermission('blog'))
                        <li class="nav-item">
                            <a href="#" class="nav-link menu-toggle {{ active(['admin.post.*', 'admin.category.*', 'admin.tag.*']) }}">
                                <i class="icon fas fa-file-alt"></i>
                                <span class="name">Блог</span>
                            </a>

                            <ul class="custom-dropdown-menu {{ active(['admin.post.*', 'admin.category.*', 'admin.tag.*']) }}">
                                <li class="nav-item">
                                    <a href="{{ route('admin.post.index') }}" class="nav-link {{ active(['admin.post.*']) }}">
                                        <i class="icon fas fa-file-alt"></i>
                                        <span class="name">Записи</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.category.index') }}" class="nav-link {{ active(['admin.category.*']) }}">
                                        <i class="icon fas fa-list"></i>
                                        <span class="name">Категории</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.tag.index') }}" class="nav-link {{ active(['admin.tag.*']) }}">
                                        <i class="icon fas fa-tag"></i>
                                        <span class="name">Теги</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif




                    @if (auth()->user()->hasPermission('user'))
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link {{ active(['admin.user.*']) }}"><i class="icon fas fa-users"></i> <span class="name">Пользователи</span></a>
                        </li>
                    @endif

                    @if (auth()->user()->hasPermission('settings'))
                        <li class="nav-item">
                            <a href="#" class="nav-link menu-toggle {{ active(['admin.settings.*', 'admin.meta.*', 'admin.template.*']) }}"><i class="icon fas fa-cogs"></i> <span class="name">Настройки</span></a>
                            <ul class="custom-dropdown-menu {{ active(['admin.settings.*', 'admin.meta.*', 'admin.template.*']) }}">
                                <li class="nav-item">
                                    <a class="nav-link {{ active(['admin.settings.index']) }}" href="{{ route('admin.settings.index') }}"><i class="icon fas fa-sliders-h"></i> <span class="name">Общие</span></a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (auth()->user()->hasPermission('cache'))
                        <li class="nav-item">
                            <a href="{{ route('admin.cache.clear') }}" class="nav-link {{ active(['admin.cache.*']) }}"><i class="icon fas fa-trash"></i> <span class="name">Очистить кеш</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="menu sidebar_toggle_wrap">
            <ul>
                <li class="nav-item">
                <a href="#" class="nav-link sidebar_toggle"><i class="icon fas fa-arrows-alt-h"></i> <span class="name">Скрыть меню</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main_wrap">
        <div class="top">
            <div class="menu">
                <a href="#top_menu" class="menu_toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <ul id="top_menu">
                    <li><a href="/" target="_blank"><i class="icon fas fa-sign-out-alt"></i> Перейти на сайт</a></li>

                    <li><a href="#">Сделать чтото</a></li>
                    <li class="dropdown">
                        <a href="#">Выпадашка</a>

                        <ul>
                            <li><a href="#">Текст ссылки 1</a></li>
                            <li><a href="#">Текст ссылки 2</a></li>
                            <li><a href="#">Текст ссылки 3</a></li>
                            <li><a href="#">Текст ссылки 4</a></li>
                            <li><a href="#" class="active">Текст ссылки 5</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="profile">
                <a href="#" class="profile_link">
                    Привет, {{ Auth::user()->name }}
                    <img src="{{ url(resize(Auth::user()->ava, 30, 30)) }}" alt="admin">
                </a>

                <div class="profile_block">
                    <a href="#" class="left">
                        <img src="{{ url(resize(Auth::user()->ava, 110, 110)) }}" alt="admin" class="ava">
                    </a>
                    <div class="right">
                        <a href="{{ route('admin.profile') }}"><i class="icon fas fa-user-edit"></i> Изменить профиль</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon fas fa-sign-out-alt"></i> Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_block">
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
