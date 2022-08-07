<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home() {
        $categories = Category::all();
        $books = Book::orderBy('id', 'DESC')->paginate(5);
        return view('main_views.home', ['categories' => $categories, 'books' => $books]);
    }

    public function single_book($book) {
        $book = Book::find($book);
        if(empty($book)) {
            abort(404);
        }

        return view('main_views.single_book', ['book' => $book]);
    }

    public function books_for_category(Category $category) {
        if($category->books->count() < 1) {
            abort(404);
        }

        $books = $category->books()->paginate(5);
        $categories = Category::all();
        return view('main_views.books_for_category', ['books' => $books, 'categories' => $categories, 'category' => $category]);
    }

    public function login_page() {
        if(auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }
}
