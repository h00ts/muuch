<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Thread extends Model implements HasMedia
{
    use Searchable;
    use HasMediaTrait;

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
