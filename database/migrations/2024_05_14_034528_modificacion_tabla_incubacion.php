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
        Schema::table('datos_incubacion', function (Blueprint $table) {
            // Cambiamos la columna existente para establecer un valor por defecto
            $table->integer('huevos_proceso')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datos_incubacion', function (Blueprint $table) {
            // Revertimos al estado anterior sin un valor por defecto específico
            // Esto podría requerir ajustes según el estado original deseado
            $table->integer('huevos_proceso')->change();
        });
    }
};
