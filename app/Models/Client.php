<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clientes';
    /**
     * Los atributos que son asignables en masa.
     * 
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'nombre', 'direccion', 'telefono', 'correo',
    ];

    /**
     * Relación con User (un cliente pertenece a un usuario).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con IncubationData (un cliente puede tener muchos datos de incubación).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function datosIncubacion()
    {
        return $this->hasMany(IncubationData::class);
    }
}