<?php

namespace App\Http\Controllers;

use App\Models\IncubationData;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\IncubationDataRequest;

class IncubationDataController extends Controller
{
    /**
     * Muestra un listado de los datos de incubación.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = IncubationData::all();
        return view('incubation.index', compact('data'));
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
        return redirect()->route('incubations_clients.index');
    }

    /**
     * Muestra los datos de incubación especificados.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\View\View
     */
    public function show(IncubationData $incubationData)
    {
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
    public function update(IncubationDataRequest $request, IncubationData $incubationData)
    {
        $validatedData = $request->validated();
        $incubationData->update($validatedData);
        return redirect()->route('incubation.index');
    }

    /**
     * Elimina los datos de incubación especificados del almacenamiento.
     *
     * @param  \App\Models\IncubationData  $incubationData
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(IncubationData $incubationData)
    {
        $incubationData->delete();
        return redirect()->route('incubation.index');
    }
}
