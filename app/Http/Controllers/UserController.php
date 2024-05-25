<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|string|email|max:255|unique:usuarios',
        'password' => 'required|string|min:8|confirmed',
        'rol' => 'required',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    $user = User::create($validatedData);

    return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }


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
    if (auth()->user()->rol === 'SuperUsuario' || auth()->user()->rol === 'Administrador') {
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'correo' => 'required|email|max:255|unique:usuarios,correo,' . $user->id,
            'password' => 'sometimes|min:8',
            'rol' => 'required',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

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
