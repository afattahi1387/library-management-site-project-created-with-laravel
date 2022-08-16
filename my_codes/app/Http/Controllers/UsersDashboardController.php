<?php

namespace App\Http\Controllers;

use App\Book;
use App\Penalty;
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

        $book_trusted = $book->trusted;
        $book->update([
            'trusted' => $book_trusted + 1
        ]);

        return redirect()->route('users.dashboard');
    }

    public function extended($book) {
        $trust = Trust::where('book_id', $book)->where('user_id', auth()->user()->id)->get()[0];
        if((time() - $trust->trusted_at) < (3600 * 24 * 14) || $trust->extended) {
            abort(404);
        }

        $trust->update([
            'extended' => 1,
            'trusted_at' => time()
        ]);

        return redirect()->route('users.dashboard');
    }

    public function restore(Trust $trust) {
        if((time() - $trust->trusted_at) < (3600 * 24 * 14)) {
            $penaltyPrice = 0;
        } else {
            $time = floor((time() - $trust->trusted_at - (3600 * 24 * 14)) / (3600 * 24));
            $penaltyPrice = $time * env('PENALTY_PRICE');
        }

        $book = Book::find($trust->book_id);
        $book_trusted = $book->trusted;
        $book->update([
            'trusted' => $book_trusted - 1
        ]);
        $trust->delete();
        if($penaltyPrice > 0) {
            Penalty::create([
                'user_id' => auth()->user()->id,
                'penalty' => $penaltyPrice
            ]);
        }

        return redirect()->route('users.dashboard');
    }
}
