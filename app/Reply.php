<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Reply extends Model implements HasMedia
{
	use Searchable;
    use HasMediaTrait;

	protected $fillable = ['body', 'thread_id'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function thread()
    {
    	return $this->belongsTo('App\Thread');
    }
}
