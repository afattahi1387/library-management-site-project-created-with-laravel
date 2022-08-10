<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trust;

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

    // public function trusted() {
    //     $user_id = auth()->user()->id;
    //     if(empty(Trust::where('book_id', $this->id)->where('user_id', $user_id)->get())) {
    //         return false;
    //     }

    //     return true;
    // }
}
