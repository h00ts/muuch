<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'description'];

    public function threads()
    {
    	$this->hasMany('App\Threads');
    }
}
