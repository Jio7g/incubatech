<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        // Asumiendo que quieres relacionar clientes con usuarios
        $users = User::all();
        return view('clients.create', compact('users'));
    }

    public function store(ClientRequest $request)
    {
        $data = $request->validated();
        $data['usuario_id'] = auth()->id();
        Client::create($data);
        return redirect()->route('clients.index')->with('success', 'Cliente creado con éxito.');
    }

    public function edit($id) // Utiliza parámetro $id para una mayor claridad en la demostración
    {
        $client = Client::findOrFail($id); // Asegúrate de manejar la excepción si no se encuentra el cliente
        if (auth()->user()->rol !== 'SuperUsuario') {
            abort(403, 'Acción no autorizada.');
        }

        return view('clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, $id)
    {
        if (auth()->user()->rol !== 'SuperUsuario')  { // Asumiendo que estás utilizando alguna librería para manejar roles como Spatie
            abort(403, 'Acción no autorizada.');
        }
    
        $client = Client::findOrFail($id); // Encuentra el cliente o falla si no existe
        $data = $request->validated(); // Valida los datos
        $client->update($data); // Actualiza el cliente con los datos validados
    
        return redirect()->route('clients.index')->with('success', 'Cliente actualizado con éxito.');
    }
    



    public function destroy(Client $client)
    {
        // Verificar si el usuario actual tiene el rol de SuperUsuario
        if (auth()->user()->rol !== 'SuperUsuario') {
            abort(403, 'Acción no autorizada.');
        }
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado con éxito.');
    }


}
