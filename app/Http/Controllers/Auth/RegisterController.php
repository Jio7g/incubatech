<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/usuarios'; // Ruta a la que redirigir después de registrar un usuario

    public function __construct()
    {
        //$this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
            'rol' => $data['rol'],
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Comentar o eliminar la siguiente línea para evitar que el usuario se loguee automáticamente
        // $this->guard()->login($user);

        // Retorna a la ruta deseada después del registro, sin iniciar sesión del usuario
        return redirect($this->redirectPath());
    }

    // Método opcional para customizar la respuesta después del registro
    protected function registered(Request $request, $user)
    {
        // Puedes añadir acciones adicionales aquí si es necesario
    }
}
