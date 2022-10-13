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
        Schema::create('datosAcademicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idInstitucion')->constrained('institucion')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idPrograma')->constrained('programa')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idEstadoAprendiz')->constrained('estadoAprendiz')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datosAcademicos');
    }
};
