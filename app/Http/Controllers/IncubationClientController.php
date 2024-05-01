<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class IncubationClientController extends Controller
{
    public function index()
    {
        // Obtiene solo los clientes que tienen datos de incubación
        $clientsWithIncubation = Client::has('datosIncubacion')->with('datosIncubacion')->get();

        return view('incubation_clients.index', compact('clientsWithIncubation'));
    }
    public function show($clientId)
    {
        $client = Client::with('datosIncubacion')->findOrFail($clientId);  // Carga previa de los datos de incubación
        $incubations = $client->datosIncubacion;  // Usar la relación correcta
    
        // Asegurarse de que siempre se pase una colección, incluso si está vacía
        if ($incubations === null) {
            $incubations = collect(); // Crea una colección vacía si no hay datos
        }
    
        return view('incubation_clients.show', compact('client', 'incubations'));
    }
    

}
