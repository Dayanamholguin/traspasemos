<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoAprendiz extends Model
{
    public $table = "estadoAprendiz";

    public $timestamps = false;
    
    protected $fillable = [
        'descripcion',
        'estado',
    ];

    public static $rules = [
        'descripcion' => ['required', 'string', 'max:50'],
    ];
}
