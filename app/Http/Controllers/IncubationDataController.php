<?php

namespace App\Http\Controllers;

use App\Models\IncubationData;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\IncubationDataRequest;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Configuracion;

class IncubationDataController extends Controller
{
    /**
     * Muestra un listado de los datos de incubación.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', Carbon::today()->toDateString());
        $fechaFin = $request->input('fecha_fin', Carbon::today()->toDateString());
        $nombreCliente = $request->input('nombre_cliente');

        $data = IncubationData::whereBetween('fecha_recepcion', [$fechaInicio, $fechaFin])
                            ->when($nombreCliente, function ($query) use ($nombreCliente) {
                                return $query->whereHas('cliente', function ($query) use ($nombreCliente) {
                                    return $query->where('nombre', 'like', '%' . $nombreCliente . '%');
                                });
                            })
                            ->with('cliente')
                            ->get();

        return view('incubation.index', compact('data', 'fechaInicio', 'fechaFin', 'nombreCliente'));
    }

    /**
     * Muestra el formulario para crear nuevos datos de incubación.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $clients = Client::all();
        return view('incubation.create', compact('clients'));
    }

    /**
     * Obtiene la lista de clientes en formato JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Guarda los datos de incubación recién creados en el almacenamiento.
     */
    public function store(IncubationDataRequest $request)
    {
        $validatedData = $request->validated();
        IncubationData::create($validatedData);
        return redirect()->route('incubation.index');
    }

    /**
     * Muestra los datos de incubación especificados.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $incubationData = IncubationData::with('cliente')->findOrFail($id);
        return view('incubation.show', compact('incubationData'));
    }

    /**
     * Muestra el formulario para editar los datos de incubación especificados.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\View\View
     */
    public function edit(IncubationData $incubationData)
    {
        $clients = Client::all();
        return view('incubation.edit', compact('incubationData', 'clients'));
    }

    /**
     * Actualiza los datos de incubación especificados en el almacenamiento.
     */

     public function update(IncubationDataRequest $request, $id)
     {
         try {
             $validatedData = $request->validated();
             $incubationData = IncubationData::findOrFail($id);
             $incubationData->update($validatedData);
         } catch (\Exception $e) {
             // Enviar el error directamente a la vista usando withErrors
             return redirect()->back()->withErrors('Error al actualizar la incubación: ' . $e->getMessage())->withInput();
         }
     
         return redirect()->route('incubation.index')->with('success', 'Datos de incubación actualizados correctamente.');
     }
     

    
    /**
     * Elimina los datos de incubación especificados del almacenamiento.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(IncubationData $incubationData)
    {
        try {
            $incubationData->delete();
            return redirect()->route('incubation.index')->with('success', 'Incubación eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo eliminar la incubación.');
        }
    }

    // IncubacionController.php
    public function imprimir($id)
    {
        $incubationData = IncubationData::with('cliente')->findOrFail($id); 
        $configuracion = Configuracion::first(); // Asume que solo hay una configuración o obtén la configuración relevante
    
        return view('incubation.imprimir', compact('incubationData', 'configuracion'));
    }
    
    
    

    
}
