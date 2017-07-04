<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $fillable = ['token', 'user_id', 'completed'];

    public function user()
    {
    	$this->belongsTo('App\User');
    }
}
