<?php

namespace App\Http\Controllers;

use App\Book;
use App\Writer;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\AddCommentRequest;

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

        $categories = Category::all();
        return view('main_views.single_book', ['book' => $book, 'categories' => $categories]);
    }

    public function books_for_category(Category $category) {
        $books = $category->books()->paginate(5);
        $categories = Category::all();
        return view('main_views.books_for_category', ['books' => $books, 'categories' => $categories, 'category' => $category]);
    }

    public function search() {
        $books = Book::where('name', 'like', '%' . $_GET['searched'] . '%')->orWhere('short_description', 'like', '%' . $_GET['searched'] . '%')->orWhere('long_description', 'like', '%' . $_GET['searched'] . '%')->paginate(5);
        $categories = Category::all();
        return view('main_views.search', ['books' => $books, 'categories' => $categories]);
    }

    public function single_writer(Writer $writer) {
        return view('main_views.writer_information', ['writer' => $writer]);
    }

    public function add_comment(AddCommentRequest $request, $book) {
        if(auth()->check()) {
            if(empty(auth()->user()->image)) {
                $user_profile = null;
            } else {
                $user_profile = auth()->user()->image;
            }
            $user_id = auth()->user()->id;
        } else {
            $user_profile = null;
            $user_id = 0;
        }

        Comment::create([
            'user_profile' => $user_profile,
            'user_name' => $request->user_name,
            'comment' => $request->comment,
            'user_id' => $user_id,
            'book_id' => $book
        ]);

        return redirect()->to(env('APP_URL') . '/single-book/' . $book . '#comments');
    }

    public function login_page() {
        if(auth()->check()) {
            return redirect()->route('redirect.to.dashboard');
        }

        return view('auth.login');
    }

    public function register_page() {
        if(auth()->check()) {
            return redirect()->route('redirect.to.dashboard');
        }

        return view('auth.register');
    }
}
