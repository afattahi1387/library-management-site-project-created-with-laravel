<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trust;

class Book extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'quantity', 'trusted', 'image', 'short_description', 'long_description', 'category_id', 'publisher_id', 'writer_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }

    public function writer() {
        return $this->belongsTo(Writer::class);
    }

    public function check_status() {
        $user_id = auth()->user()->id;
        $trust = Trust::where('user_id', $user_id)->where('book_id', $this->id)->get();
        if((time() - $trust[0]->trusted_at) < (3600 * 24 * 14)) {
            return 'trusted';
        }

        if($trust[0]->extended) {
            return 'extended';
        } else {
            return 'dont_extended';
        }
    }

    public function trusted() {
        if(!auth()->check()) {
            return false;
        }

        $user_id =  auth()->user()->id;
        return Trust::where('user_id', $user_id)->where('book_id', $this->id)->exists();
    }
}
