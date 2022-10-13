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
        Schema::create('institucion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('idCiudad')->constrained('ciudad')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nombre');
            $table->string('nit');
            $table->string('docDane');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('nombreRector');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('institucion');
    }
};
