<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoFicha extends Model
{
    public $table = "estadoFicha";

    public $timestamps = false;
    
    protected $fillable = [
        'descripcion',
        'estado',
    ];

    public static $rules = [
        'descripcion' => ['required', 'string', 'max:50'],
    ];
}
