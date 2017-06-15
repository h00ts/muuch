<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

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
        return $this->belongsToMany('App\Module')->withTimestamps();
    }

    public function answers()
    {
        return $this->belongsToMany('App\Answer')->withTimestamps();
    }

    public function content()
    {
        return $this->belongsToMany('App\Content')->withTimestamps();
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
