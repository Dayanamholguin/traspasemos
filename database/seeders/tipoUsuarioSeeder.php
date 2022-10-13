<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoUsuario')->insert([
            'descripcion' => 'Administrador',
        ]);
        DB::table('tipoUsuario')->insert([
            'descripcion' => 'Instructor',
        ]);
        DB::table('tipoUsuario')->insert([
            'descripcion' => 'Aprendiz',
        ]);
        DB::table('tipoUsuario')->insert([
            'descripcion' => 'Psicólogo',
        ]);
    }
}
