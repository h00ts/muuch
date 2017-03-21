<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'level', 'module', 'name', 'description',
    ];

    public function contents()
    {
    	return $this->hasMany('App\Content');
    }

    public function exams()
    {
    	return $this->hasMany('App\Exam');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function scores()
    {
    	return $this->hasManyThrough('App\Score', 'App\Exam');
    }
}
 