<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BitacoraController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $fechaInicio = $request->input('fecha_inicio', Carbon::today()->toDateString());
            $fechaFin = $request->input('fecha_fin', Carbon::today()->toDateString());
            $nombreCliente = $request->input('nombre_cliente');

            $bitacoras = Bitacora::whereBetween('fecha_recepcion', [$fechaInicio, $fechaFin])
                ->when($nombreCliente, function ($query) use ($nombreCliente) {
                    return $query->whereHas('cliente', function ($query) use ($nombreCliente) {
                        return $query->where('nombre', 'like', '%' . $nombreCliente . '%');
                    });
                })
                ->with('cliente')
                ->get();

            return view('bitacoras.index', compact('bitacoras', 'fechaInicio', 'fechaFin', 'nombreCliente'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function show($id)
    {
        // Verificar si el usuario tiene el rol de Usuario, Administrador o SuperUsuario
        if (auth()->user()->rol === 'Usuario' || auth()->user()->rol === 'Administrador' || auth()->user()->rol === 'SuperUsuario') {
            $bitacora = Bitacora::with('cliente')->findOrFail($id);
            return view('bitacoras.show', compact('bitacora'));
        }

        abort(403, 'Acción no autorizada.');
    }
}
