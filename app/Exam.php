<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'min_score',
    ];

    public function module()
    {
    	return $this->belongsTo('App\Module');
    }

    public function questions()
    {
    	return $this->hasMany('App\Question');
    }

    public function scores()
    {
    	return $this->hasMany('App\Scores');
    }

    public function answers()
    {
    	return $this->hasManyThrough('App\Answer', 'App\Question');
    }

    public function users()
    {
    	return $this->hasManyThrough('App\User', 'App\Score');
    }
}
