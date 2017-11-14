<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Ilucentro extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name', 'short_name', 'coordinates', 'direccion', 'municipio', 'estado'];

    public function users()
    {
    	$this->hasMany('App\User');
    }
}
