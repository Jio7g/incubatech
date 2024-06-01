<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;
    // Especifica el nombre de la tabla si no es el predeterminado 'users'
    protected $table = 'usuarios';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'correo', 'password', 'rol', // Asegúrate de que estos campos coincidan con las columnas de tu tabla 'usuarios'
    ];

    /**
     * Relación con Client (un usuario puede tener muchos clientes).
     * Asegúrate de que el modelo 'Client' esté también correctamente definido y relacionado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        // Asume que tienes un modelo 'Client' relacionado
        return $this->hasMany(Client::class);
    }

    // Si estás usando Laravel para la autenticación, es posible que también quieras especificar qué columna es 'email' en tu tabla
    public function getEmailAttribute()
    {
        return 'correo';
    }
}
