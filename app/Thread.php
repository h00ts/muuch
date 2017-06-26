<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	protected $fillable = ['title', 'body', 'user_id', 'category_id'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function replies()
    {
    	return $this->hasMany('App\Reply');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
