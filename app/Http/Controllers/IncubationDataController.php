<?php

namespace App\Http\Controllers;

use App\Models\IncubationData;
use App\Models\Client; 
use Illuminate\Http\Request;

class IncubationDataController extends Controller
{
    public function index()
    {
        $data = IncubationData::all();
        return view('incubation.index', compact('data'));
    }

    public function create()
    {
        $clients = Client::all(); // Asume que tienes un modelo Client
        return view('incubation.create', compact('clients'));
    }
    
    public function getClients()
{
    $clients = Client::all();
    return response()->json($clients);
}


    public function store(Request $request)
    {
        $request->validate([
            'fecha_recepcion'=> 'required',
            'cliente_id' => 'required',
            'producto' => 'required',
            'cantidad' => 'required|numeric',
            'tipo_huevo' => 'required',
            'numero_bandeja' => 'required',
            'etapa' => 'nullable',
            'estado' => 'nullable',
            'descripcion' => 'nullable',
            // Añade más validaciones según necesites
        ]);
    
        IncubationData::create($request->all());
        return redirect()->route('incubations_clients.index'); // Asegúrate de que esta ruta exista y sea correcta
    }
    

    public function show(IncubationData $incubationData)
    {
        return view('incubation.show', compact('incubationData'));
    }

    public function edit(IncubationData $incubationData)
    {
        return view('incubation.edit', compact('incubationData'));
    }

    public function update(Request $request, IncubationData $incubationData)
    {
        $request->validate([
            'fecha_recepcion'=> 'required',
            'cliente_id' => 'required',
            'producto' => 'required',
            'cantidad' => 'required|numeric',
            'tipo_huevo' => 'required',
            'numero_bandeja' => 'required',
            'etapa' => 'nullable',
            'estado' => 'nullable',
            'descripcion' => 'nullable',
            // Añade más validaciones según necesites
        ]);

        $incubationData->update($request->all());
        return redirect()->route('incubation.index');
    }

    public function destroy(IncubationData $incubationData)
    {
        $incubationData->delete();
        return redirect()->route('incubation.index');
    }
}
