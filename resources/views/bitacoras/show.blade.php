@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Bitácora</h1>
    <table class="table">
        <tr>
            <th>ID de Bitácora</th>
            <td>{{ $bitacora->id }}</td>
        </tr>
        <tr>
            <th>Nombre del Cliente</th>
            <td>{{ $bitacora->cliente->nombre }}</td>
        </tr>
        <tr>
            <th>Fecha de Recepción</th>
            <td>{{ $bitacora->fecha_recepcion }}</td>
        </tr>
        <tr>
            <th>Huevos al Inicio</th>
            <td>{{ $bitacora->huevos_inicio }}</td>
        </tr>
        <tr>
            <th>Huevos Malos</th>
            <td>{{ $bitacora->huevos_malos }}</td>
        </tr>
        <tr>
            <th>Huevos Incubados</th>
            <td>{{ $bitacora->huevos_incubados }}</td>
        </tr>
        <tr>
            <th>Fecha de Entrega</th>
            <td>{{ $bitacora->fecha_entrega }}</td>
        </tr>
    </table>
</div>
@endsection
