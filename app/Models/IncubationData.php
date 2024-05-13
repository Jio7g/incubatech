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
        'fecha_recepcion', 'cliente_id', 'producto', 'cantidad', 'tipo_huevo', 'numero_bandeja', 'etapa', 'estado', 'descripcion', 'huevos_malos', 'huevos_proceso', 'fecha_entrega'
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

    public function actualizaciones()
{
    return $this->hasMany(Actualizacion::class, 'incubacion_id');
}


    public function save(array $options = [])
    {
        // Asigna huevos_proceso a cantidad cuando se crea una nueva incubación
        if (!$this->exists && empty($this->huevos_proceso)) {
            $this->huevos_proceso = $this->cantidad;
        }

        parent::save($options);
    }

    public function getHuevosMalosAttribute()
{
    // Si el modelo aún no se ha guardado, devolver el valor original
    if (!$this->exists) {
        return $this->attributes['huevos_malos'] ?? 0;
    }

    // Suma los huevos malos de todas las actualizaciones
    return $this->actualizaciones()->sum('huevos_malos');
}

}
