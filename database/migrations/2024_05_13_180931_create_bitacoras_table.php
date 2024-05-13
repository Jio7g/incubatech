<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacorasTable extends Migration
{
    public function up()
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incubacion_id')->constrained('datos_incubacion');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->integer('huevos_inicio');
            $table->integer('huevos_malos');
            $table->integer('huevos_incubados');
            $table->date('fecha_recepcion');
            $table->date('fecha_entrega');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bitacoras');
    }
}

