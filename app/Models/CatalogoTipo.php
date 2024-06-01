<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoTipo extends Model
{
    protected $fillable = ['nombre', 'estado']; // Permitir asignación masiva para estos campos
    
    use HasFactory;
}
