/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
require('jquery.cookie');
require('select2');
import elFinderBrowser from './admin/elfinder.js';

window.elFinderBrowser = elFinderBrowser;


$('.menu-toggle').click(function() {
    $('.custom-dropdown-menu', $(this).parent()).slideToggle();

    return false;
});


$('.sidebar_toggle').click(function() {
    $('body').toggleClass('collapsed_sidebar');


    var cookie = 'hide';

    if ($.cookie('menu_toggle') == 'hide') {
        cookie = 'show';
    }

    $.cookie('menu_toggle', cookie, { expires: 7, path: '/' });
});

$('.multiple_select').select2({
    placeholder: 'Выберите элементы',
    theme: 'bootstrap4',
    allowClear: true,
    closeOnSelect: false
});
