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
            // Cambiar la columna para que acepte valores nulos y tenga un default de 0

            $table->integer('huevos_proceso')->default(0)->nullable()->change();
            $table->text('descripcion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datos_incubacion', function (Blueprint $table) {
            // Revertir a la configuración original, aquí asumo que no era nullable
            // Es importante ajustar esto según la definición original de la columna
            $table->integer('huevos_proceso')->nullable(false)->change();
            $table->text('descripcion')->nullable(false)->change();
        });
    }
};
