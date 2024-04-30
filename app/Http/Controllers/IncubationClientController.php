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
}
