@extends('layouts.app') {{-- Asegúrate de que tienes un layout base llamado app. --}}

@section('content')
<div class="container">
    <h1>Listado de Datos de Incubación</h1>
    <a href="{{ route('incubation.create') }}" class="btn btn-primary">Agregar Nuevo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Recepción</th>
                <th>Cliente ID</th>
                <th>Codigo Cliente</th>
                <th>Nombre Cliente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->fecha_recepcion }}</td>
                <td>{{ $item->cliente_id }}</td>
                <td>{{ $item->cliente_codigo }}</td>
                <td>{{ $item->cliente_nombre }}</td>
                <td>
                    <a href="{{ route('incubation.show', $item) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('incubation.edit', $item) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('incubation.destroy', $item) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este registro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
