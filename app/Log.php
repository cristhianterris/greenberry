<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    
    protected $table = 'logs';
    protected $fillable = [
        'user_id','user_nombre','accion','tabla','detalle','created_at'
        
    ];
    public $timestamps = false;
}
