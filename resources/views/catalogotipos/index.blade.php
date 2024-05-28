<!-- resources/views/catalogotipos/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Catálogo de tipo de huevos</h1>
    <a href="{{ route('catalogotipos.create') }}" class="btn btn-primary">Agregar Nuevo Tipo</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($catalogoTipos as $tipo)
                <tr>
                    <td>{{ $tipo->nombre }}</td>
                    <td>
                        <a href="{{ route('catalogotipos.edit', $tipo->id) }}" class="btn btn-sm btn-info">Editar</a>
                        
                        <!-- Formulario para eliminar -->
                        <form action="{{ route('catalogotipos.destroy', $tipo->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tipo?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
