<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
 	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'question',
    ];

    public function exam()
    {
    	return $this->belongsTo('App\Exam');
    }

    public function answers()
    {
    	return $this->hasMany('App\Answer');
    }
}
