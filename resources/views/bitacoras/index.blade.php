@extends('layouts.app')

@section('content')
<form action="{{ route('bitacoras.index') }}" method="GET">
    <label for="fecha_inicio">Fecha Inicio:</label>
    <input type="date" name="fecha_inicio" value="{{ $fechaInicio }}">

    <label for="fecha_fin">Fecha Fin:</label>
    <input type="date" name="fecha_fin" value="{{ $fechaFin }}">

    <label for="nombre_cliente">Nombre del Cliente:</label>
    <input type="text" name="nombre_cliente" placeholder="Buscar por nombre..." value="{{ $nombreCliente }}">

    <button type="submit">Buscar</button>
</form>

<h1>Lista de Bitácoras</h1>
<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Fecha de Recepción</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bitacoras as $bitacora)
            <tr>
                <td>{{ $bitacora->cliente->nombre }}</td>
                <td>{{ $bitacora->fecha_recepcion }}</td>
                <td>
                    <a href="{{ route('bitacoras.show', $bitacora->id) }}">Ver Detalles</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
