<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;

class Content extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'html', 'css', 'js', 'markdown',
    ];

    public function module()
    {
    	return $this->belongsTo('App\Module');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function getMarkupAttribute()
    {
        return Markdown::convertToHtml($this->markdown);
    }
}
