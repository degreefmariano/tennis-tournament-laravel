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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('habilidad');
            $table->integer('fuerza')->nullable();
            $table->integer('velocidad')->nullable();
            $table->integer('tiempo_reaccion')->nullable();
            $table->integer('suerte')->nullable();
            $table->enum('genero', ['Masculino', 'Femenino']);
            $table->foreignId('torneo_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('jugadores');
    }
};
