<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracions';

    protected $fillable = [
        'nit_empresa', 'nombre_empresa', 'direccion_empresa', 'telefono_empresa', 'correo_empresa', 'logo_empresa'
    ];
}
