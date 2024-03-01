<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instructores', function (Blueprint $table) {
            $table->unsignedInteger("id")->autoIncrement();
            $table->string('profesion')->nullable();
            $table->string('estado')->nullable();
            $table->unsignedSmallInteger("user_id");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instructores');
    }
};
