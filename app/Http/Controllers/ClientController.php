<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|email|max:255|unique:clientes',
        ]);
    
        // Asignar el usuario autenticado al cliente
        $data['usuario_id'] = auth()->id(); // Obtiene el ID del usuario autenticado
    
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
    
    public function update(Request $request, $id) // Utiliza parámetro $id
    {
        $client = Client::findOrFail($id); // Encuentra el cliente o falla
        if (auth()->user()->rol !== 'SuperUsuario') {
            abort(403, 'Acción no autorizada.');
        }
    
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'correo' => 'required|email|max:255|unique:clientes,correo,' . $client->id,
        ]);
    
        $client->update($data);
    
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
