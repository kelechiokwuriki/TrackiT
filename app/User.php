<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Session;
use App\Exercise;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function getApiTokenAttribute($value)
    {
        if(!$value) {
            $value = Str::random(80);
            $this->api_token = $value;
            $this->save();
        }

        return $value;
    }
}
