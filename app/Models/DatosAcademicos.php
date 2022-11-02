<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosAcademicos extends Model
{
    public $table = "datosAcademicos";

    public $timestamps = false;
    
    protected $fillable = [
        'idUsuario',
        'idInstitucion',
        'idPrograma',
        'idEstadoAprendiz',
        'estado',
    ];

    public static $rules = [
        'idUsuario' =>['required', 'exists:users,id'],
        'idInstitucion' => ['required', 'exists:institucion,id'],
        'idPrograma' => ['required', 'exists:programa,id'],
        'idEstadoAprendiz' => ['required', 'exists:estadoAprendiz,id'],
    ];
}
