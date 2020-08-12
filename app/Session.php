<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exercise;
use App\User;

class Session extends Model
{
    protected $guarded = [];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
