<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
 	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'answer', 'correct',
    ];

    public function question()
    {
    	return $this->belongsTo('App\Question'); 
    }

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }
}
