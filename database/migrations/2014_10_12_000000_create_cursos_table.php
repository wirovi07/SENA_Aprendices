<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->unsignedSmallInteger("id")->autoIncrement();
            $table->string('ficha')->nullable();
            $table->string('nombre')->nullable();
            $table->string('jornada')->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_final')->nullable();
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
