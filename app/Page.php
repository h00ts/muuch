<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Page extends Model implements HasMedia
{
    use Searchable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'markdown', 'icon', 'image', 'slug', 'menu'
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
