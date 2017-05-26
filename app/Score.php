<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    public function exam()
    {
    	return $this->belongsTo('App\Exam');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
