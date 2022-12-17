<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    
    protected $table = 'personas';
    protected $fillable = [
        'tipo_abreviatura','abreviatura','detalle','created_at','updated_at'
    ];
    public $timestamps = true;
}
