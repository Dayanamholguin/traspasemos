<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    public $table = "profesional";

    public $timestamps = false;

    protected $fillable = [
        'idTipoDocumento',
        'numeroDocumentoProfesional',
        'nombreProfesional',
        'apellidoProfesional',
        'telefono',
        'email',
        'estado',
    ];

    public static $rules = [
        'nombreProfesional' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'], 
        'apellidoProfesional' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/'],
        'numeroDocumentoProfesional' => ['required', 'numeric'],
        'telefono' => ['required', 'numeric'],
        'idTipoDocumento' => ['required', 'exists:tipoDocumento,id'],
    ];
}
