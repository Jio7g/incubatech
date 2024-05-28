<?php


namespace App\Http\Controllers;

use App\Models\CatalogoTipo;
use Illuminate\Http\Request;

class CatalogoTipoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo tipo.
     */
    public function index()
    {
        $catalogoTipos = CatalogoTipo::all(); // Obtener todos los tipos de catálogo de la base de datos
        return view('catalogotipos.index', compact('catalogoTipos')); // Pasar la variable a la vista
    }
    

    public function create()
    {
        return view('catalogotipos.create');
    }

    /**
     * Guarda un nuevo tipo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
    
        $catalogoTipo = new CatalogoTipo([
            'nombre' => $request->nombre,
            'estado' => true  // Establecer 'estado' siempre a true
        ]);
        $catalogoTipo->save();
    
        return redirect()->route('catalogotipos.index');
    }
    

    /**
     * Muestra el formulario para editar un tipo existente.
     */
    public function edit($id)
    {
        $catalogoTipo = CatalogoTipo::findOrFail($id);
        return view('catalogotipos.edit', compact('catalogoTipo'));
    }
    
    /**
     * Actualiza un tipo en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',  // Solo validamos el nombre
        ]);
    
        $catalogoTipo = CatalogoTipo::findOrFail($id);
        $catalogoTipo->update([
            'nombre' => $request->nombre,
            'estado' => true  // Mantenemos siempre el estado en true
        ]);
    
        return redirect()->route('catalogotipos.index');
    }
    

    /**
     * Elimina un tipo de la base de datos.
     */
    public function destroy($id)
    {
        $catalogoTipo = CatalogoTipo::findOrFail($id);
        $catalogoTipo->delete();

        return redirect()->route('catalogotipos.index')->with('success', 'Tipo eliminado exitosamente');
    }
}

