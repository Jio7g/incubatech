<?php

namespace App\Http\Controllers;

use App\Models\Actualizacion;
use App\Models\IncubationData;
use App\Models\Client;
use Illuminate\Http\Request;

class ActualizacionController extends Controller
{
    public function index()
    {
        $actualizaciones = Actualizacion::all();
        return view('actualizaciones.index', compact('actualizaciones'));
    }

    public function create($incubacion_id)
    {
        $incubacion = IncubationData::findOrFail($incubacion_id);
        $clientes = Client::all(); // Asumiendo que necesitas listar clientes
        return view('actualizaciones.create', compact('incubacion', 'clientes'));
    }
    

    public function store(Request $request)
    {
        $request->merge(['fecha_actualizacion' => now()]);

        $request->validate([
            'incubacion_id' => 'required',
            'cliente_id' => 'required',
            'fecha_actualizacion' => 'required|date',
            'huevos_inicio' => 'required|integer',
            'huevos_malos' => 'required|integer',
            'huevos_eclosionados' => 'required|integer',
            'etapa' => 'required|string',
            'estado' => 'required|string',
            'descripcion' => 'required|string'
        ]);

        $actualizacion = new Actualizacion($request->all());
        $actualizacion->save(); // Esto llama al método save en el modelo que incluye la lógica de negocio

        return redirect()->route('incubations_clients.index')->with('success', 'Actualización creada correctamente.');
    }
}
