<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterUserRequest;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Ruta a la que redirigir después de registrar un usuario.
     *
     * @var string
     */
    protected $redirectTo = '/usuarios';

    /**
     * Constructor del controlador.
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Crea una nueva instancia de usuario después de la validación.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'password' => Hash::make($data['password']),
            'rol' => $data['rol'],
        ]);
    }

    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Maneja una solicitud de registro.
     *
     * @param  \App\Http\Requests\RegisterUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterUserRequest $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validated();
    
        // Crear el usuario
        User::create($validatedData);
    
        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->route('login')->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    /**
     * Método opcional para customizar la respuesta después del registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function registered(Request $request, $user)
    {
        // Puedes añadir acciones adicionales aquí si es necesario
    }
}