@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de Recepcion de Huevos</h1>
    <table class="table">
        <tr>
            <th>ID de incubationData</th>
            <td>{{ $incubationData->id }}</td>
        </tr>
        <tr>
            <th>Nombre del Cliente</th>
            <td>{{ $incubationData->cliente->nombre }}</td>
        </tr>
        <tr>
            <th>Fecha de Recepción</th>
            <td>{{ $incubationData->fecha_recepcion }}</td>
        </tr>
        <tr>
            <th>Etapa</th>
            <td>{{ $incubationData->etapa }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>{{ $incubationData->estado }}</td>
        </tr>
        <tr>
            <th>Huevos al Inicio</th>
            <td>{{ $incubationData->cantidad }}</td>
        </tr>
        <tr>
            <th>Huevos Malos</th>
            <td>{{ $incubationData->huevos_malos }}</td>
        </tr>
        <tr>
            <th>Huevos Eclosionados</th>
            <td>{{ $incubationData->huevos_eclosionados }}</td>
        </tr>
        <tr>
            <th>Huevos Incubados</th>
            <td>{{ $incubationData->huevos_proceso }}</td>
        </tr>

        <tr>
            <th>Descripcion</th>
            <td>{{ $incubationData->descripcion }}</td>
        </tr>
        <tr>
            <th>Fecha de Entrega</th>
            <td>{{ $incubationData->fecha_entrega }}</td>
        </tr>
    </table>
</div>
@endsection
