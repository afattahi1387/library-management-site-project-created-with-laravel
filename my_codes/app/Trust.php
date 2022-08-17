<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trust extends Model
{
    protected $fillable = ['book_id', 'extended', 'user_id', 'trusted_at'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    function status() {
        $time1 = 3600 * 24 * 14;
        $time2 = floor(time() - $this->trusted_at - $time1);
        if($time2 < 0) {
            return ['good', ''];
        } else {
            $day = 3600 * 24;
            $penalty_time = floor($time2 / $day);
            $penalty_price = $penalty_time * env('PENALTY_PRICE');
            return ['penalty', $penalty_price];
        }
    }
}
