<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_profile', 'user_name', 'comment', 'user_id', 'book_id'];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
