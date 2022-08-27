<?php

namespace App\Http\Controllers;

use App\Book;
use App\Notifications\TrustBook;
use App\Penalty;
use App\Trust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class UsersDashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        $trusted_books = Trust::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('users_panel.users_dashboard', ['trusted_books' => $trusted_books]);
    }

    public function trust(Book $book) {
        $trust = Trust::create([
            'book_id' => $book->id,
            'user_id' => auth()->user()->id,
            'trusted_at' => time()
        ]);

        $book_trusted = $book->trusted;
        $book->update([
            'trusted' => $book_trusted + 1
        ]);

        Notification::send(auth()->user(), new TrustBook($trust));

        return redirect()->route('users.dashboard');
    }

    public function extended($book, $user) {
        $trust = Trust::where('book_id', $book)->where('user_id', $user)->get()[0];
        if((time() - $trust->trusted_at) < (3600 * 24 * 14) || $trust->extended) {
            abort(404);
        }

        $trust->update([
            'extended' => 1,
            'trusted_at' => time()
        ]);

        if(auth()->user()->type == 'admin') {
            return redirect()->route('get.user.trusted.books', ['user' => $user]);
        } else {
            return redirect()->route('users.dashboard');
        }
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
        $trust_user = $trust->user->id;
        $trust->delete();
        if($penaltyPrice > 0) {
            Penalty::create([
                'user_id' => auth()->user()->id,
                'book_name' => $book->name,
                'penalty' => $penaltyPrice
            ]);
        }

        if(auth()->user()->type == 'admin') {
            return redirect()->route('get.user.trusted.books', ['user' => $trust_user]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function penalties() {
        $penalties = Penalty::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        $sum_of_penalties = 0;
        foreach($penalties as $penalty) {
            $sum_of_penalties += $penalty->penalty;
        }
        return view('users_panel.user_penalties', ['penalties' => $penalties, 'sum_of_penalties' => $sum_of_penalties]);
    }
}
