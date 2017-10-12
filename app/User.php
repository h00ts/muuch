<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements HasMedia
{
    use HasMediaTrait;
    use Notifiable;
    use EntrustUserTrait { restore as private restoreA; }
    use SoftDeletes { restore as private restoreB; }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ilucentro_id', 'phone', 'extension', 'descripcion', 'posicion'
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

    public function activity()
    {
        return $this->hasMany('Spatie\Activitylog\Models\Activity', 'causer_id');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }
}
