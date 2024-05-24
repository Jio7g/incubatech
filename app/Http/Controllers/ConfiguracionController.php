<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{
    public function index()
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            $configuraciones = Configuracion::all();
            return view('configuracion.index', compact('configuraciones'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function create()
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            return view('configuracion.create');
        }

        abort(403, 'Acción no autorizada.');
    }

    public function store(Request $request)
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            $input = $request->all();
            if ($request->hasFile('logo_empresa')) {
                $input['logo_empresa'] = $request->file('logo_empresa')->store('logos', 'public');
            }
            Configuracion::create($input);
            return redirect()->route('configuracion.index')->with('success', 'Configuración guardada exitosamente.');
        }

        abort(403, 'Acción no autorizada.');
    }

    public function edit(Configuracion $configuracion)
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            return view('configuracion.edit', compact('configuracion'));
        }

        abort(403, 'Acción no autorizada.');
    }

    public function update(Request $request, Configuracion $configuracion)
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            $input = $request->all();
            if ($request->hasFile('logo_empresa')) {
                if ($configuracion->logo_empresa) {
                    Storage::disk('public')->delete($configuracion->logo_empresa);
                }
                $input['logo_empresa'] = $request->file('logo_empresa')->store('logos', 'public');
            }
            $configuracion->update($input);
            return redirect()->route('configuracion.index')->with('success', 'Configuración actualizada exitosamente.');
        }

        abort(403, 'Acción no autorizada.');
    }

    public function destroy(Configuracion $configuracion)
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            $configuracion->delete();
            return redirect()->route('configuracion.index')->with('success', 'Configuración eliminada exitosamente.');
        }

        abort(403, 'Acción no autorizada.');
    }

    public function show($id)
    {
        // Verificar si el usuario tiene el rol de SuperUsuario
        if (auth()->user()->rol === 'SuperUsuario') {
            $configuracion = Configuracion::find($id);
            return view('incubation.imprimir', compact('configuracion'));
        }

        abort(403, 'Acción no autorizada.');
    }
}
