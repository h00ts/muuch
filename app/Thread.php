<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Thread extends Model
{
    use Searchable;

	protected $fillable = ['title', 'body', 'user_id', 'channel_id'];

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

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }
}
