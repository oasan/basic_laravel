<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
                        <a class="nav-link" href="#"><i class="icon fas fa-home"></i> <span class="name">Главная</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon fas fa-file-alt"></i> <span class="name">Страницы</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#"><i class="icon fas fa-link"></i> <span class="name">Отключенная ссылка</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link menu-toggle active"><i class="icon fas fa-users"></i> <span class="name">Пользователи</span></a>
                        <ul class="custom-dropdown-menu active">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><i class="icon fas fa-list"></i> <span class="name">Список пользователей</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="icon fas fa-user-cog"></i> <span class="name">Права</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link menu-toggle"><i class="icon fas fa-cogs"></i> <span class="name">Настройки</span></a>
                        <ul class="custom-dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><i class="icon fas fa-sliders-h"></i> <span class="name">Общие</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="icon fas fa-cog"></i> <span class="name">Еще какието</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="icon fas fa-cog"></i> <span class="name">Еще настройки</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#"><i class="icon fas fa-cog"></i> <span class="name">Disabled</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="menu sidebar_toggle_wrap">
            <ul <li class="nav-item">
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
                    <li><a href="#" class="active"><i class="icon fas fa-sign-out-alt"></i> Перейти на сайт</a></li>
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
                <a href="#" class="profile_link">Привет, admin <img src="uploads/user.png" alt="admin"></a>

                <div class="profile_block">
                    <a href="#" class="left">
                        <img src="uploads/user.png" alt="admin" class="ava">
                    </a>
                    <div class="right">
                        <a href="#"><i class="icon fas fa-user-edit"></i> Изменить профиль</a>
                        <a href="#"><i class="icon fas fa-sign-out-alt"></i> Выйти</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_block">

            <a href="#" class="float-right btn btn-success add-item-btn"><i class="fa fa-plus"></i> Создать новый элемент</a>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Список какихто элементов</li>
                </ol>
            </nav>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Название</th>
                        <th scope="col" class="text-center">Опубликовано</th>
                        <th scope="col">Дата публикации</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Дата изменения</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row_middle">
                        <th scope="row">1</th>
                        <td>
                            <img src="uploads/element_sq.jpg" alt="" class="circle" width="60">
                        </td>
                        <td>Название элемента</td>
                        <td class="text-center">
                            <i class="icon green fas fa-check"></i>
                        </td>
                        <td>2018-04-24 10:13:42</td>
                        <td>2018-04-24 10:13:42</td>
                        <td>2018-04-24 10:13:42</td>
                        <td class="controls">
                            <a href="#" target="_blank" class="btn btn-primary">
                                <i class="icon fas fa-eye"></i>
                            </a>

                            <a href="#" class="btn btn-primary">
                                <i class="icon fas fa-pencil-alt"></i>
                            </a>

                            <form method="POST" action="#" accept-charset="UTF-8" class="inline-block">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden" value="">
                                <button type="submit" class="btn delete btn-danger">
                                    <span class="fas fa-times"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="row_middle">
                        <th scope="row">1</th>
                        <td>
                            <img src="pictures/element_sq.jpg" alt="" class="circle" width="60">
                        </td>
                        <td>Название элемента</td>
                        <td class="text-center">
                            <i class="icon fas fa-spinner wheel"></i>
                        </td>
                        <td>2018-04-24 10:13:42</td>
                        <td>2018-04-24 10:13:42</td>
                        <td>2018-04-24 10:13:42</td>
                        <td class="controls">
                            <a href="#" target="_blank" class="btn btn-primary">
                                <i class="icon fas fa-eye"></i>
                            </a>

                            <a href="#" class="btn btn-primary">
                                <i class="icon fas fa-pencil-alt"></i>
                            </a>

                            <form method="POST" action="#" accept-charset="UTF-8" class="inline-block">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden" value="">
                                <button type="submit" class="btn delete btn-danger">
                                    <span class="fas fa-times"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="row_middle">
                        <th scope="row">1</th>
                        <td>
                            <img src="pictures/element_sq.jpg" alt="" class="circle" width="60">
                        </td>
                        <td>Название элемента</td>
                        <td class="text-center">
                            <i class="icon fas fa-times"></i>
                        </td>
                        <td>2018-04-24 10:13:42</td>
                        <td>2018-04-24 10:13:42</td>
                        <td>2018-04-24 10:13:42</td>
                        <td class="controls">
                            <a href="#" target="_blank" class="btn btn-primary">
                                <i class="icon fas fa-eye"></i>
                            </a>

                            <a href="#" class="btn btn-primary">
                                <i class="icon fas fa-pencil-alt"></i>
                            </a>

                            <form method="POST" action="#" accept-charset="UTF-8" class="inline-block">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden" value="">
                                <button type="submit" class="btn delete btn-danger">
                                    <span class="fas fa-times"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="content_block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Список какихто элементов</a></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Создание какогото элемента</li>
                </ol>
            </nav>

            <form method="POST" action="#" accept-charset="UTF-8" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                <input name="_token" type="hidden" value="Lj6Uakwh5w1nhA5othKuaiHNxBxMPoCYw9MDARQo">


                <div class="form-group">
                    <label for="name">Название</label>
                    <input class="form-control" id="name" name="name" type="text" value="">
                </div>

                <div class="form-group">
                    <label for="text">Аннотация</label>
                    <textarea class="form-control" rows="4" name="introtext" cols="50"></textarea>
                </div>

                <div class="form-group">
                    <label for="text">Текст</label>
                    <textarea class="form-control" rows="4" name="text" cols="50"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Изображение</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                </div>

                <div class="form-group">
                    <label for="category">Категория</label>
                    <select class="form-control" id="category" name="category">
                        <option value="Категория 1">Категория 1</option>
                        <option value="Категория 2">Категория 2</option>
                        <option value="Категория 3">Категория 3</option>
                        <option value="Категория 4" selected>Категория 4</option>
                        <option value="Категория 5">Категория 5</option>
                        <option value="Категория 6">Категория 6</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="categories">Категории</label>
                    <select multiple class="form-control multiple_select" id="categories" name="categories[]">
                        <option value="Категория 1">Категория 1</option>
                        <option value="Категория 2">Категория 2</option>
                        <option value="Категория 3" selected>Категория 3</option>
                        <option value="Категория 4" selected>Категория 4</option>
                        <option value="Категория 5">Категория 5</option>
                        <option value="Категория 6">Категория 6</option>
                    </select>
                </div>

                <div class="form-group datetime_wrap">
                    <label for="published_at">Дата публикации</label>
                    <input class="form-control datetime" id="published_at" name="published_at" type="text" value="2018-04-23 09:00:12">
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="hidden" name="published" value="0">
                        <input class="form-check-input" type="checkbox" name="published" value="1" id="published">
                        <label class="form-check-label" for="published">
                            опубликовано
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="hidden" name="param1" value="0">
                        <input class="form-check-input" type="checkbox" name="param1" value="1" id="param1">
                        <label class="form-check-label" for="param1">
                            Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Все, лучше послушавшись диких большого бросил парадигматическая деревни он? Путь собрал послушавшись свой осталось семь ты, точках мир заманивший путь!
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input type="hidden" name="param2" value="0">
                        <input class="form-check-input" type="checkbox" name="param2" value="1" id="param2" disabled>
                        <label class="form-check-label" for="param2">
                            Пустился, свой раз даль, имени букв алфавит курсивных, себя силуэт текста родного подпоясал даже текстами, заманивший ты имеет? Алфавит свою, возвращайся пустился себя рукописи щеке большого путь проектах имени пунктуация?
                        </label>
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="color" id="color_blue" value="blue" checked>
                        <label class="form-check-label" for="color_blue">
                            Синий
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="color" id="color_green" value="green">
                        <label class="form-check-label" for="color_green">
                            Зеленый
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="color" id="color_red" value="red" disabled>
                        <label class="form-check-label" for="red">
                            Красный
                        </label>
                    </div>
                </div>

                <p>
                    <a href="#" class="btn btn-danger"><i class="fa fa-undo"></i> Отмена</a>
                    <button type="submit" name="save_and_close" class="btn btn-success">
                        <i class="fa fa-save"></i> Сохранить и выйти
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Сохранить
                    </button>
                </p>


                <br>
                <br>
                <br>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

            </form>
        </div>
    </div>

    <script src="{{ mix('/assets/js/admin.js') }}"></script>
</body>

</html>
