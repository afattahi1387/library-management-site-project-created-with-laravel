<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function books() {
        return $this->hasMany(Book::class);
    }
}
