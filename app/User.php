<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function modules()
    {
        return $this->belongsToMany('App\Module');
    }

    public function answers()
    {
        return $this->belongsToMany('App\Answer');
    }

    public function scores()
    {
        return $this->hasMany('App\Score');
    }

    public function exams()
    {
        return $this->hasManyThrough('App\Exam', 'App\Score');
    }
}
