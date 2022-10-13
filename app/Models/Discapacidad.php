<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    public $table = "discapacidad";

    public $timestamps = false;
    
    protected $fillable = [
        'descripcion',
        'link',
        'estado',
    ];

    public static $rules = [
        'descripcion' => ['required', 'string', 'max:500'], 
        'link' => ['required', 'string', 'max:500'],
    ];
}
