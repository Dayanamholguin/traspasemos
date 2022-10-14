<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class departamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamento')->insert([
            'descripcion' => 'Amazonas',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Antioquia',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Arauca',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Atlántico',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Bolívar',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Boyacá',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Caldas',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Caquetá',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Casanare',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Cauca',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Cesar',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Chocó',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Córdoba',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Cundinamarca',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Güainia',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Guaviare',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Huila',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'La Guajira',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Magdalena',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Meta',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Nariño',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Norte de Santander',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Putumayo',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Quindo',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Risaralda',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'San Andrés y Providencia',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Santander',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Sucre',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Tolima',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Valle del Cauca',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Vaupés',
        ]);
        DB::table('departamento')->insert([
            'descripcion' => 'Vichada',
        ]);
    }
}
