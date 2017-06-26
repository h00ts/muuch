<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Thread extends Model
{
    use Searchable;

	protected $fillable = ['title', 'body', 'user_id', 'category_id'];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'threads_index';
    }

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
