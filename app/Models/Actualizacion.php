<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bitacora; // Asegúrate de tener el namespace correcto para Bitacora

class Actualizacion extends Model
{
    protected $table = 'actualizaciones';

    protected $fillable = [
        'incubacion_id', 'cliente_id', 'fecha_actualizacion', 'huevos_inicio', 'huevos_malos', 'huevos_proceso', 'etapa', 'estado', 'descripcion', 'huevos_eclosionados'
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
        // Asegúrate de que los datos necesarios están cargados
        $this->load('incubacion');
    
        if (isset($this->huevos_malos, $this->huevos_eclosionados)) {
            // Sumar a los huevos malos existentes
            $this->incubacion->huevos_malos += $this->huevos_malos;
            $this->incubacion->huevos_eclosionados+= $this->huevos_eclosionados;
    
            // Calcular huevos en proceso basado en el valor previo y los nuevos huevos malos y huevos eclosionados
            $this->incubacion->huevos_proceso = max(0, $this->incubacion->huevos_proceso - $this->huevos_malos - $this->huevos_eclosionados);
    
            // Guardar los cambios en incubacion
            $this->incubacion->etapa = $this->etapa;
            $this->incubacion->estado = $this->estado;
            $this->incubacion->save();
        }
         
        // Aquí aseguras que   `huevos_proceso` tiene un valor antes de guardar `Actualizacion`
        $this->huevos_proceso = $this->incubacion->huevos_proceso;
    
        // Procede con el guardado habitual
        parent::save($options);

    // Si el estado es 'finalizado', manejar la finalización
    if ($this->estado == 'finalizado') {
        $this->incubacion->fecha_entrega = $this->fecha_actualizacion;
        $this->incubacion->save();

        // Registrar el evento en la Bitácora
        Bitacora::create([
            'incubacion_id' => $this->incubacion_id,
            'cliente_id' => $this->cliente_id,
            'huevos_inicio' => $this->incubacion->cantidad,
            'huevos_malos' => $this->incubacion->huevos_malos,
            'huevos_incubados' => $this->incubacion->huevos_eclosionados,
            'fecha_recepcion' => $this->incubacion->fecha_recepcion,
            'fecha_entrega' => $this->fecha_actualizacion,
            'estado' => $this->estado,
        ]);
    }
}


    
}
