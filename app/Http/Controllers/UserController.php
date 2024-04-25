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
        $users = User::all(); // Cambia $auth a $users aquí
        return view('users.index', compact('users')); // Pasa 'users' a la vista
    }

    // ...
public function edit(User $user)
{
    // Pasa el usuario a la vista para editarlo
    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    // Validación de los datos
    $data = $request->validate([
        'nombre' => 'required|max:255',
        'correo' => 'required|email|max:255|unique:usuarios,correo,' . $user->id,
        // No es necesario validar la contraseña aquí si no quieres que se actualice cada vez.
        'rol' => 'required',
    ]);

    // Actualiza el usuario con los datos validados
    $user->update($data);

    // Redirige a donde quieras después de la actualización, por ejemplo, de vuelta a la lista de usuarios.
    return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
}
// ...
public function destroy(User $user)
{
    // Verificar si el usuario actual tiene el rol de SuperUsuario
    if (auth()->user()->rol !== 'SuperUsuario') {
        abort(403, 'Acción no autorizada.');
    }

    $user->delete();

    return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
}

}
