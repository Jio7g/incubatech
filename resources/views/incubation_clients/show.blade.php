@extends('layouts.app') {{-- Asegúrate de que tienes un layout base llamado app. --}}

@section('content')
<div class="container">
    <h1>Incubaciones de {{ $client->nombre }}</h1>
    <p>
        <strong>Dirección:</strong> {{ $client->direccion }}<br>
        <strong>Teléfono:</strong> {{ $client->telefono }}
    </p>
    <a href="{{ route('incubations_clients.index') }}" class="btn btn-primary">Volver a Incubaciones</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha de Recepción</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Tipo de Huevo</th>
                <th>No. Bandeja</th>
                <th>Etapa</th>
                <th>Estado</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incubations as $incubation)
            <tr>
                <td>{{ $incubation->fecha_recepcion }}</td>
                <td>{{ $incubation->producto }}</td>
                <td>{{ $incubation->cantidad }}</td>
                <td>{{ $incubation->tipo_huevo }}</td>
                <td>{{ $incubation->numero_bandeja }}</td>
                <td>{{ $incubation->etapa }}</td>
                <td>{{ $incubation->estado }}</td>
                <td>{{ $incubation->descripcion }}</td>
                <td>
                    <!--boton actualizar-->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
