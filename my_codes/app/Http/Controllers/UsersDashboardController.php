<?php

namespace App\Http\Controllers;

use App\Book;
use App\Trust;
use Illuminate\Http\Request;

class UsersDashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        $trusted_books = Trust::where('user_id', auth()->user()->id)->get();
        return view('users_panel.users_dashboard', ['trusted_books' => $trusted_books]);
    }

    public function trust(Book $book) {
        Trust::create([
            'book_id' => $book->id,
            'user_id' => auth()->user()->id,
            'trusted_at' => time()
        ]);

        $book_quantity = $book->quantity;
        $book->update([
            'quantity' => $book_quantity - 1
        ]);

        return redirect()->route('users.dashboard');
    }
}
