<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoDocumento')->insert([
            'descripcion' => 'Cédula de Ciudadanía',
            'abreviatura' => 'CC',
        ]);
        DB::table('tipoDocumento')->insert([
            'descripcion' => 'Tarjeta de Identidad',
            'abreviatura' => 'TI',
        ]);
        DB::table('tipoDocumento')->insert([
            'descripcion' => 'Cédula de Extranjería',
            'abreviatura' => 'CE',
        ]);
        DB::table('tipoDocumento')->insert([
            'descripcion' => 'Permiso Especial de Permanencia',
            'abreviatura' => 'PEP',
        ]);
    }
}
