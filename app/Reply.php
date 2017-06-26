<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Reply extends Model
{
	use Searchable;

	 /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'replies_index';
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function thread()
    {
    	return $this->belongsTo('App\Thread');
    }
}
