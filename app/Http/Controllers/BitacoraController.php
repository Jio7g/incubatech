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

    public function show($id)
    {
        $bitacora = Bitacora::with('cliente')->findOrFail($id);
        return view('bitacoras.show', compact('bitacora'));
    }
}

