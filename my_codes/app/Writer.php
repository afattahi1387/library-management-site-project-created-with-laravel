<?php

namespace App;

use App\Follower;
use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $fillable = ['name', 'description', 'image'];

    public function books() {
        return $this->hasMany(Book::class)->orderBy('id', 'DESC');
    }

    public function followers() {
        return $this->hasMany(Follower::class);
    }

    public function is_follower($user_id) {
        $follower_count = Follower::where('user_id', $user_id)->where('writer_id', $this->id)->count();
        if($follower_count == 1) {
            return true;
        }

        return false;
    }
}
