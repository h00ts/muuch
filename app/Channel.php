<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'description'];

    public function threads()
    {
    	return $this->hasMany('App\Thread');
    }

    public function replies()
    {
        return $this->hasManyThrough('App\Reply', 'App\Thread');
    }
}
