<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

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
        'name', 'email', 'password', 'ilucentro_id'
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

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function ilucentro()
    {
        return $this->belongsTo('App\Ilucentro');
    }

    public function activation()
    {
        return $this->hasOne('App\Activation');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
