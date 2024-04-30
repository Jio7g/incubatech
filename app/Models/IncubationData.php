<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncubationData extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'datos_incubacion';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'fecha_recepcion', 'cliente_id', 'producto', 'cantidad', 'tipo_huevo', 'numero_bandeja', 'etapa', 'estado', 'descripcion', 'fecha_entrega'
    ];

    /**
     * Relación con Client (los datos de incubación pertenecen a un cliente).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Client::class);
    }
}
