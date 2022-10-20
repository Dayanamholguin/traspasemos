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
        Schema::create('reporteInstitucion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idInstitucion')->constrained('institucion')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idDiscapacidad')->constrained('discapacidad')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idNee')->constrained('nee')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idProfesional')->constrained('profesional')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->text('observacionDiscapacidad');
            $table->text('observaciones');
            $table->boolean('diagnosticado')->default(0);
            $table->date('fechaReporte');
            $table->text('recomendacion');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reporteInstitucion');
    }
};
