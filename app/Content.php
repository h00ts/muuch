<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;
use Laravel\Scout\Searchable;

class Content extends Model
{
    use Searchable;

	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'html', 'css', 'js', 'markdown', 'cover', 'file', 'page_id', 'module_id', 'description', 'folio'
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
