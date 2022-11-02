<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    public $table = "ficha";

    public $timestamps = false;
    
    protected $fillable = [
        'numeroFicha',
        'idPrograma',
        'idInstitucion',
        'idInstructor',
        'idEstadoFicha',
        'estado',
    ];

    public static $rules = [
        'numeroFicha' => ['required', 'numeric'],
        'idPrograma' =>['required', 'exists:users,id'],
        'idInstitucion' => ['required', 'exists:institucion,id'],
        'idInstructor' => ['required', 'exists:users,id'],
        'idEstadoFicha' => ['required', 'exists:estadoAprendiz,id'],
    ];
}
