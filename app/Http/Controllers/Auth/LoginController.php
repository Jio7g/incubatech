<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';  // Asegúrate de que esta ruta está definida en tus archivos de rutas

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'correo'; // Esto debería reflejar el nombre de la columna de tu base de datos
    }

    public function showLoginForm()
    {
        $configuracion = Configuracion::first();
        return view('auth.login', compact('configuracion'));
    }

}
