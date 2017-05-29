<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'markdown', 'icon', 'image',
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
