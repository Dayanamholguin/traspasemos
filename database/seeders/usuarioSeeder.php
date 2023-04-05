<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'idTipoDocumento' => 1,
            'idTipoUsuario' => 1,
            'numeroDocumento' => '1000000000',
            'nombre' => 'Administrador',
            'apellido' => 'Administrador',
            'email' => 'admin@yopmail.com',
            'estado' => 1,
            'password' => Hash::make("123456789"),
            'created_at' => "2022/05/02",
            'updated_at' => "2022/05/02",
        ]);
    }
}
