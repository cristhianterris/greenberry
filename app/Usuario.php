<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    
    protected $table = 'users';
    protected $fillable = [
        'codigo','nombres','anexo','sede','area','piso','created_at','updated_at'
        
    ];
    public $timestamps = true;
}
