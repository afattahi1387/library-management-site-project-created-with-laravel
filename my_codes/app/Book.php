<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trust;
use App\Vote;

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

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function votes($vote) {
        return Vote::where('book_id', $this->id)->where('vote', $vote)->count();
    }

    public function check_trust_status($user_id) {
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

    public function check_status() {
        $user_id = auth()->user()->id;
        return self::check_trust_status($user_id);
    }

    public function trusted() {
        if(!auth()->check()) {
            return false;
        }

        $user_id =  auth()->user()->id;
        return Trust::where('user_id', $user_id)->where('book_id', $this->id)->exists();
    }
}
