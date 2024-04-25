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
            $table->date('fecha_recepcion')->nullable(); // Añadir la columna fecha_recepcion
            $table->date('fecha_entrega')->nullable(); // Añadir la columna fecha_entrega
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datos_incubacion', function (Blueprint $table) {
            $table->dropColumn('fecha_recepcion'); // Eliminar la columna fecha_recepcion
            $table->dropColumn('fecha_entrega'); // Eliminar la columna fecha_entrega
        });
    }
};
