<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionsTable extends Migration
{
    public function up()
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->string('nit_empresa');
            $table->string('nombre_empresa');
            $table->string('direccion_empresa');
            $table->string('telefono_empresa');
            $table->string('correo_empresa');
            $table->string('logo_empresa')->nullable(); // El logo puede ser opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configuracions');
    }
}

