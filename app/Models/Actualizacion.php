<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bitacora; // Asegúrate de tener el namespace correcto para Bitacora

class Actualizacion extends Model
{
    protected $table = 'actualizaciones';

    protected $fillable = [
        'incubacion_id', 'cliente_id', 'fecha_actualizacion', 'huevos_inicio', 'huevos_malos', 'huevos_proceso', 'etapa', 'estado', 'descripcion'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Establecer la fecha_actualizacion al día actual antes de guardar el modelo
            $model->fecha_actualizacion = now();
        });
    }

    public function incubacion()
    {
        return $this->belongsTo(IncubationData::class, 'incubacion_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Client::class, 'cliente_id');
    }

    

    public function save(array $options = [])
    {
        // Siempre actualizar huevos_proceso en IncubationData antes de guardar la actualización
        if (isset($this->huevos_inicio) && isset($this->huevos_malos)) {
            $this->huevos_proceso = $this->huevos_inicio - $this->huevos_malos;
            $this->incubacion->huevos_proceso = $this->huevos_proceso;
            $this->incubacion->huevos_malos = $this->huevos_malos;
            $this->incubacion->etapa = $this->etapa;
            $this->incubacion->estado = $this->estado;
            $this->incubacion->save();
        }

        parent::save($options);
    
        if ($this->estado == 'finalizado') {
            $this->incubacion->fecha_entrega = $this->fecha_actualizacion;
            $this->incubacion->save();

            // Calcular los huevos incubados como la diferencia entre huevos_inicio y huevos_malos
            $huevos_incubados = $this->huevos_inicio - $this->huevos_malos;

            // Crear entrada en Bitacora
            Bitacora::create([
                'incubacion_id' => $this->incubacion_id,
                'cliente_id' => $this->cliente_id,
                'huevos_inicio' => $this->huevos_inicio,
                'huevos_malos' => $this->huevos_malos,
                'huevos_incubados' => $huevos_incubados,
                'fecha_recepcion' => $this->incubacion->fecha_recepcion,
                'fecha_entrega' => $this->fecha_actualizacion,
                'estado' => $this->estado,
            ]);
        }
    }
}
