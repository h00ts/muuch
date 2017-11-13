<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impacto extends Model
{
	protected $table = 'impacto';
	
    protected $fillable = ['beneficiarios', 'sistemas', 'potencia', 'energia', 'co2', 'equipo', 'embajadores', 'enlaces', 'escuelas'];
}
