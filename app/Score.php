<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
	protected $fillable = ['score', 'level', 'exam_id', 'user_id', 'passed', 'status', 'percent', 'top'];

    public function exam()
    {
    	return $this->belongsTo('App\Exam');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function answers()
    {
    	return $this->hasManyThrough('App\Answers', 'App\Exam');
    }

    public function module()
    {
        return $this->belongsTo('App\Module');
    }
}
