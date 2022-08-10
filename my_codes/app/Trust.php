<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trust extends Model
{
    protected $fillable = ['book_id', 'user_id', 'trusted_at'];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
