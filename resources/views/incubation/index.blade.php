@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Datos de Incubación</h1>
    <a href="{{ route('incubation.create') }}" class="btn btn-primary">Agregar Nuevo</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

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
                    <a href="{{ route('incubation.show', $item->id) }}">Ver Detalles</a>
                    <a href="{{ route('incubation.edit', $item) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('incubation.destroy', $item) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este registro?')">Eliminar</button>
                    </form>
                    <a href="{{ route('incubation.imprimir', $item->id) }}" target="_blank">Imprimir</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
