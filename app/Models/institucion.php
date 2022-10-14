<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class institucion extends Model
{
    public $table = "institucion";

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'nit',
        'docDane',
        'direccion',
        'telefono',
        'nombreRector',
        'idCiudad',
        'estado',
    ];
    public static $rules = [
        'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'], 
        'nit' => ['required', 'string'],
        'docDane' => ['required', 'string'],
        'direccion' => ['required', 'string', 'max:255'],
        'telefono' => ['required', 'numeric'],
        'nombreRector' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
        'idCiudad' => ['required', 'exists:ciudad,id'],
        // 'estado' => ['required', 'in:0,1'],
    ];
}
