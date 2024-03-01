<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->foreign('nombre_cliente')->references('nombre')->on('clientes')->onDelete('cascade');
            $table->string('nombre_producto');
            $table->string('cantidad'); // Cambiar a un tipo de datos adecuado
            $table->decimal('total', 10, 2); // Cambiar a un tipo de datos adecuado
            $table->string('cp');
            $table->string('direccion');
            $table->string('municipio');
            $table->string('referencia');
            $table->string('num_tarjeta');
            $table->string('nom_titular');
            $table->string('expiracion'); 
            $table->string('cvc');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
