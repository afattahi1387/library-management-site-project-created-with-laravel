<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = [
        'publisher_name'
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }
}
