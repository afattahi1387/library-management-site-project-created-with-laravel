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

Route::get('/', 'MainController@home')->name('home');

Route::get('/single-book/{book}', 'MainController@single_book')->name('single.book');

Auth::routes();

Route::get('/login', 'MainController@login_page')->name('login.page');

Route::get('/dashboard', function() {
    return 'dashboard';
})->name('dashboard');
