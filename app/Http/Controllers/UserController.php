<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verificar si el usuario actual tiene el rol de SuperUsuario o Administrador
        if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador') {
            $users = User::all();
            return view('users.index', compact('users'));
        }

        abort(403, 'Acción no autorizada.');
    }

    // ...

    public function edit(User $user)
    {
        // Verificar si el usuario actual tiene el rol de SuperUsuario o Administrador
        if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador') {
            return view('users.edit', compact('user'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function update(Request $request, User $user)
    {
        // Verificar si el usuario actual tiene el rol de SuperUsuario o Administrador
        if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador') {
            // Validación de los datos
            $data = $request->validate([
                'nombre' => 'required|max:255',
                'correo' => 'required|email|max:255|unique:usuarios,correo,' . $user->id,
                'rol' => 'required',
            ]);

            // Actualiza el usuario con los datos validados
            $user->update($data);

            return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
        }

        abort(403, 'Acción no autorizada.');
    }

    // ...

    public function destroy(User $user)
    {
        // Verificar si el usuario actual tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
        }

        abort(403, 'Acción no autorizada.');
    }
}
