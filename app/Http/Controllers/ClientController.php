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
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $clients = Client::all();
            return view('clients.index', compact('clients'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function create()
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $users = User::all();
            return view('clients.create', compact('users'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function store(ClientRequest $request)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $data = $request->validated();
            $data['usuario_id'] = auth()->id();
            Client::create($data);
            return redirect()->route('clients.index')->with('success', 'Cliente creado con éxito.');
        }

        abort(403, 'Acción no autorizada.');
    }

    public function edit($id)
    {
        // Verificar si el usuario tiene el rol de Administrador o SuperUsuario
        if (auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $client = Client::findOrFail($id);
            return view('clients.edit', compact('client'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function update(ClientRequest $request, $id)
    {
        // Verificar si el usuario tiene el rol de Administrador o SuperUsuario
        if (auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $client = Client::findOrFail($id);
            $data = $request->validated();
            $client->update($data);
            return redirect()->route('clients.index')->with('success', 'Cliente actualizado con éxito.');
        }

        abort(403, 'Acción no autorizada.');
    }

    public function destroy(Client $client)
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Cliente eliminado con éxito.');
        }

        abort(403, 'Acción no autorizada.');
    }
}
