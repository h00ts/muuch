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
    	'name', 'html', 'css', 'js', 'markdown', 'cover', 'file', 'page_id'
    ];

    public function module()
    {
    	return $this->belongsTo('App\Module');
    }

    public function page()
    {
        return $this->belongsTo('App\Page');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();;
    }

    public function getMarkupAttribute()
    {
        return Markdown::convertToHtml($this->markdown);
    }

    public function isCompletedBy($user_id)
    {
        return $this->where('content_user.content_id', $this->id)->get();
    }
}
