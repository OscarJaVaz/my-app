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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idRol');
            $table->foreign('idRol')->references('id')->on('roles')->onDelete('cascade');
            $table->string('nombre')->unique();
            $table->string('apellido');
            $table->string('email');
            $table->string('telefono');
            $table->string('contrasena');
            $table->string('domicilio');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
