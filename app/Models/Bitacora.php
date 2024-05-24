<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';

    protected $fillable = [
        'incubacion_id', 'cliente_id', 'huevos_inicio', 'huevos_malos', 'huevos_incubados', 'fecha_recepcion', 'fecha_entrega'
    ];

    public function cliente()
{
    return $this->belongsTo(Client::class, 'cliente_id');
}

}


