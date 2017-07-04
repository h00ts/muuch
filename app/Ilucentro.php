<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ilucentro extends Model
{
    protected $fillable = ['name', 'coordinates', 'direccion', 'municipio', 'estado'];

    public function user()
    {
    	$this->hasMany('App\User');
    }
}
