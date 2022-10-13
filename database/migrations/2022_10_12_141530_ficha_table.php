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
        Schema::create('ficha', function (Blueprint $table) {
            $table->id();            
            $table->string('numeroFicha');
            $table->foreignId('idPrograma')->constrained('programa')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idInstitucion')->constrained('institucion')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idInstructor')->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('idEstadoFicha')->constrained('estadoFicha')->onUpdate('cascade')
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
        Schema::drop('ficha');
    }
};
