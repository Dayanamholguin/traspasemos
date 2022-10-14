<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NEE extends Model
{
    public $table = "nee";

    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'link',
        'estado',
    ];

    public static $rules = [
        'nombre' => ['required', 'string', 'max:50'], 
        'descripcion' => ['required', 'string', 'max:200'], 
        'link' => ['required', 'string', 'max:500'],
    ];
}
