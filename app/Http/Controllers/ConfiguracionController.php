<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage; // Añade esta línea aquí


class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones = Configuracion::all();
        return view('configuracion.index', compact('configuraciones'));
    }

    public function create()
    {
        return view('configuracion.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->hasFile('logo_empresa')) {
            $input['logo_empresa'] = $request->file('logo_empresa')->store('logos', 'public');
        }
        Configuracion::create($input);
        return redirect()->route('configuracion.index')->with('success', 'Configuración guardada exitosamente.');
    }

    public function edit(Configuracion $configuracion)
    {
        return view('configuracion.edit', compact('configuracion'));
    }

    public function update(Request $request, Configuracion $configuracion)
    {
        $input = $request->all();
        if ($request->hasFile('logo_empresa')) {
            // Eliminar el logo antiguo si existe
            if ($configuracion->logo_empresa) {
                Storage::disk('public')->delete($configuracion->logo_empresa);
            }
            $input['logo_empresa'] = $request->file('logo_empresa')->store('logos', 'public');
        }
        $configuracion->update($input);
        return redirect()->route('configuracion.index')->with('success', 'Configuración actualizada exitosamente.');
    }

    public function destroy(Configuracion $configuracion)
    {
        $configuracion->delete();
        return redirect()->route('configuracion.index')->with('success', 'Configuración eliminada exitosamente.');
    }

    public function show($id)
{
    $configuracion = Configuracion::find($id);
    return view('incubation.imprimir', compact('configuracion'));
}

}
