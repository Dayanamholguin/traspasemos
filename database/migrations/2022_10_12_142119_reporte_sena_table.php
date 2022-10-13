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
        Schema::create('reporteSena', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idInstructor')->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idInstitucion')->constrained('institucion')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idFicha')->constrained('ficha')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idUsuarioApr')->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('fechaReporte');
            $table->text('observacion');
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
        Schema::drop('reporteSena');
    }
};
