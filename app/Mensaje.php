<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    
    protected $table = 'mensajes';
    protected $fillable = [
        'contacto','correo','asunto','mensaje','created_at'
        
    ];
    public $timestamps = false;
}
