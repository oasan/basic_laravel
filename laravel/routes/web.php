<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.layout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::namespace('Admin')
     ->middleware(['auth', /*'auth_admin'*/])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {


    Route::get('', 'DashboardController@index')->name('index');
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('profile', 'ProfileController@update')->name('profile.update');

    Route::get('/cache/clear', 'CacheController@clear')->name('cache.clear');

    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('/user/{user}/ban', 'UserController@ban')->name('user.ban');
    Route::get('/user/{user}/unlock', 'UserController@unlock')->name('user.unlock');
    Route::get('/user/{user}/login', 'UserController@login')->name('user.login');



    Route::resource('page', 'PageController', ['except' => ['show']]);

    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::post('/settings', 'SettingsController@save')->name('settings.save');

});


// Route::get('/home', 'HomeController@index')->name('home');
// $urls = Cache::rememberForever('urls', function() {
//     $urls = DB::table('urls')
//                 ->pluck('url')
//                 ->toArray();

//     return $urls;
// });

// if (!empty($urls)) {
//     foreach ($urls as $url) {
//         Route::get($url, 'UrlController@show')->name('url.show');
//     }
// }
