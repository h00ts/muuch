<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'parent_id', 'slug', 'order'
    ];

    public function pages()
    {
    	return $this->hasMany('App\Page');
    }

    public function threads()
    {
    	return $this->hasMany('App\Thread');
    }
}
