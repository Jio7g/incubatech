<?php

namespace App\Http\Controllers;

use App\Models\IncubationData;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\IncubationDataRequest;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Configuracion;
use App\Models\CatalogoTipo;

class IncubationDataController extends Controller
{
    /**
     * Muestra un listado de los datos de incubación.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
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

        abort(403, 'Acción no autorizada.');
    }

    /**
     * Muestra el formulario para crear nuevos datos de incubación.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $clients = Client::all();
            $catalogoTipos = CatalogoTipo::where('estado', true)->get(); // Obtener los tipos de huevos activos
            return view('incubation.create', compact('clients', 'catalogoTipos'));
        }
    
        abort(403, 'Acción no autorizada.');
    }
    
    /**
     * Obtiene la lista de clientes en formato JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients()
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $clients = Client::all();
            return response()->json($clients);
        }

        abort(403, 'Acción no autorizada.');
    }

    /**
     * Guarda los datos de incubación recién creados en el almacenamiento.
     */
    public function store(IncubationDataRequest $request)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $validatedData = $request->validated();
            IncubationData::create($validatedData);
            return redirect()->route('incubation.index');
        }

        abort(403, 'Acción no autorizada.');
    }

    /**
     * Muestra los datos de incubación especificados.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $incubationData = IncubationData::with('cliente')->findOrFail($id);
            return view('incubation.show', compact('incubationData'));
        }

        abort(403, 'Acción no autorizada.');
    }

    /**
     * Muestra el formulario para editar los datos de incubación especificados.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\View\View
     */
    public function edit(IncubationData $incubationData)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $clients = Client::all();
            return view('incubation.edit', compact('incubationData', 'clients'));
        }

        abort(403, 'Acción no autorizada.');
    }

    /**
     * Actualiza los datos de incubación especificados en el almacenamiento.
     */
    public function update(IncubationDataRequest $request, $id)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
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

        abort(403, 'Acción no autorizada.');
    }

    /**
     * Elimina los datos de incubación especificados del almacenamiento.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(IncubationData $incubationData)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            try {
                $incubationData->delete();
                return redirect()->route('incubation.index')->with('success', 'Incubación eliminada correctamente.');
            } catch (\Exception $e) {
                return back()->with('error', 'No se pudo eliminar la incubación.');
            }
        }

        abort(403, 'Acción no autorizada.');
    }

    public function imprimir($id)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $incubationData = IncubationData::with('cliente')->findOrFail($id);
            $configuracion = Configuracion::first();

            return view('incubation.imprimir', compact('incubationData', 'configuracion'));
        }

        abort(403, 'Acción no autorizada.');
    }
}
