<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'quantity', 'image', 'short_description', 'long_description', 'category_id', 'publisher_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }
}
