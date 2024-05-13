<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualizacionsTable extends Migration
{
    public function up()
    {
        Schema::create('actualizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incubacion_id')->constrained('datos_incubacion');
            $table->foreignId('cliente_id')->constrained('clientes'); // Asumiendo que tienes una tabla de clientes
            $table->date('fecha_actualizacion');
            $table->integer('huevos_inicio');
            $table->integer('huevos_malos');
            $table->integer('huevos_proceso');
            $table->string('etapa');
            $table->string('estado');
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actualizaciones');
    }
}
