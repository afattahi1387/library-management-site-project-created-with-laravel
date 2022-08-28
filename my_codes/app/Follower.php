<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = ['user_id', 'writer_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
