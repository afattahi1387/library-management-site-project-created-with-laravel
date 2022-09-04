<?php

namespace App\Http\Controllers;

use App\Book;
use App\Vote;
use App\Writer;
use App\Comment;
use App\Message;
use App\Category;
use App\Follower;
use Illuminate\Http\Request;
use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\AddMessageRequest;
use App\MailNews;
use App\Notifications\ReceivedMessage;
use App\User;
use Illuminate\Support\Facades\Notification;

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

    public function contact_us() {
        return view('main_views.contact-us');
    }

    public function add_message_in_contact_us(AddMessageRequest $request) {
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        $admins = User::where('type', 'admin')->get();
        foreach($admins as $admin) {
            Notification::send($admin, new ReceivedMessage($request->name));
        }

        echo "<script>alert('پیام شما با موفقیت ثبت شد.');</script>";
        echo "<script>window.location.href='" . route('home') . "';</script>";
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

    public function add_vote($book_id, $vote) {
        Vote::create([
            'book_id' => $book_id,
            'vote' => $vote
        ]);

        return redirect()->to(env('APP_URL') . '/single-book/' . $book_id . '#add_vote');
    }

    public function follow_writer(Writer $writer) {
        Follower::create([
            'user_id' => auth()->user()->id,
            'writer_id' => $writer->id
        ]);

        return redirect()->route('single.writer', ['writer' => $writer->id]);
    }

    public function add_to_mail_news(Request $request) {
        MailNews::create([
            'email' => $request->user_email
        ]);

        echo "<script>alert('شما در خبرنامه عضو شدید.');</script>";
        echo "<script>window.location.href='" . env('APP_URL') . "';</script>";
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

    public function password_reset_page() {
        if(auth()->check()) {
            return redirect()->route('redirect.to.dashboard');
        }

        return view('auth.passwords.email');
    }
}
