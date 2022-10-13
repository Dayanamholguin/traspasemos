<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datosContactos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idCiudad')->constrained('ciudad')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('telefonoFijo');
            $table->string('foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datosContactos');
    }
};
