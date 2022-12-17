<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    
    protected $table = 'configuracion';
    protected $fillable = [
        'entrada_recomendada','contrasenia_predeterminada','correo','created_at'
    ];
    public $timestamps = false;
}
