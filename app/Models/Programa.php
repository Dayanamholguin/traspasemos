<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    public $table = "programa";

    public $timestamps = false;
    
    protected $fillable = [
        'descripcion',
        'version',
        'link',
        'estado',
    ];

    public static $rules = [
        'descripcion' => ['required', 'string', 'max:500'], 
        'version' => ['required', 'string', 'max:100'],
        'link' => ['required', 'string', 'max:500'],
    ];
}
