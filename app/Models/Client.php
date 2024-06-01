<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clientes';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
        'codigo',
        'nombre',
        'direccion',
        'telefono',
        'correo',
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
        return $this->hasMany(IncubationData::class, 'cliente_id'); // `id` es la columna por defecto para la clave primaria
    }

    /**
     * Genera automáticamente el código de cliente antes de crear un nuevo registro.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            $client->codigo = $client->generateClientCode();
        });
    }

    /**
     * Genera un nuevo código de cliente correlativo.
     *
     * @return string
     */
    public function generateClientCode()
    {
        $lastClient = self::orderBy('id', 'desc')->first();

        if ($lastClient) {
            $lastCode = $lastClient->codigo;
            $newCode = intval($lastCode) + 1;
        } else {
            $newCode = 1;
        }

        return str_pad($newCode, 6, '0', STR_PAD_LEFT);
    }
}
