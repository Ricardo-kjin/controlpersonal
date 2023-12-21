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
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nro_venta');
            $table->date('fecha_venta');
            $table->decimal('total_venta', 10, 2);
            $table->integer('transaccion')->nullable();
            $table->string('estado_venta')->nullable();
            $table->text('tcParametro')->nullable(); // Usar el tipo text para permitir longitudes mayores
            $table->unsignedBigInteger('tipopago_id');
            $table->foreign('tipopago_id')->references('id')->on('tipo_pagos')->onDelete('cascade');
            $table->unsignedBigInteger('promocion_id');
            $table->foreign('promocion_id')->references('id')->on('promocions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
