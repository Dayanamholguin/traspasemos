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
        Schema::create('profesional', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idTipoDocumento')->constrained('tipoDocumento')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('numeroDocumentoProfesional');
            $table->string('nombreProfesional');
            $table->string('apellidoProfesional');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->boolean('estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profesional');
    }
};
