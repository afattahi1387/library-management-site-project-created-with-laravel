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

Route::get('/category/{category}', 'MainController@books_for_category')->name('category.books');

Route::get('/search', 'MainController@search')->name('search');

Auth::routes();

Route::get('/login', 'MainController@login_page')->name('login.page');

Route::get('/register', 'MainController@register_page')->name('register.page');

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

Route::get('/redirect-to-dashboard', function() {
    if(auth()->user()->type == 'admin') {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('users.dashboard');
    }
})->middleware('auth')->name('redirect.to.dashboard');

Route::prefix('panel')->group(function() {
    Route::post('/add-category', 'DashboardController@add_category')->name('category.add');

    Route::put('/edit-category/{category}', 'DashboardController@update_category')->name('category.update');

    Route::get('/publishers', 'DashboardController@publishers_page')->name('publishers.page');

    Route::post('/add-publisher', 'DashboardController@add_publisher')->name('publisher.add');

    Route::put('/edit-publisher/{publisher}', 'DashboardController@update_publisher')->name('publisher.update');

    Route::get('/books', 'DashboardController@books_page')->name('books.page');

    Route::delete('/delete-book/{book}', 'DashboardController@delete_book')->name('book.delete');

    Route::get('/add-book', 'DashboardController@add_book_page')->name('book.add.page');

    Route::post('/create-book', 'DashboardController@create_book')->name('book.create');

    Route::get('/add-image/{book}', 'DashboardController@add_image_page')->name('book.add.image');

    Route::post('/upload-image/{book}', 'DashboardController@upload_image')->name('book.image.upload');

    Route::get('/edit-book/{book}', 'DashboardController@edit_book')->name('book.edit');

    Route::put('/update-book/{book}', 'DashboardController@update_book')->name('book.update');

    Route::get('/trash', 'DashboardController@trash')->name('trash');

    Route::delete('/move-to-trash/{book}', 'DashboardController@move_to_trash')->name('move.to.trash');

    Route::get('/recovery/{book}', 'DashboardController@recovery')->name('trash.books.recovery');

    Route::delete('/delete-category/{category}', 'DashboardController@delete_category')->name('category.delete');

    Route::delete('/delete-publisher/{publisher}', 'DashboardController@delete_publisher')->name('publisher.delete');
});

Route::prefix('users')->group(function() {
    Route::get('/dashboard', 'UsersDashboardController@dashboard')->name('users.dashboard');
});
