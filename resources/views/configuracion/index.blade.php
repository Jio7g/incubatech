@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Configuración</h1>
    <a href="{{ route('configuracion.create') }}" class="btn btn-primary">Crear Configuración</a>
    <table class="table">
        <thead>
            <tr>
                <th>NIT</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($configuraciones as $configuracion)
            <tr>
                <td>{{ $configuracion->nit_empresa }}</td>
                <td>{{ $configuracion->nombre_empresa }}</td>
                <td>{{ $configuracion->direccion_empresa }}</td>
                <td>{{ $configuracion->telefono_empresa }}</td>
                <td>{{ $configuracion->correo_empresa }}</td>
                <td>
                    <a href="{{ route('configuracion.edit', $configuracion) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('configuracion.destroy', $configuracion) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
