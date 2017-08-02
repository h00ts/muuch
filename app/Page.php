<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Page extends Model
{
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'markdown', 'icon', 'image', 'slug'
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
