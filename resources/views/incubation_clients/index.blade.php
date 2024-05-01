@extends('layouts.app') {{-- Asegúrate de que tienes un layout base llamado app. --}}

@section('content')
<div class="container">
<a href="{{ route('incubation.create') }}" class="btn btn-primary">Agregar Nuevo</a>
    <h1>Clientes con Datos de Incubación</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientsWithIncubation as $client)
            <tr>
                <td>{{ $client->nombre }}</td>
                <td>{{ $client->direccion }}</td>
                <td>{{ $client->telefono }}</td>
                <td>
                    <!--incluir botones-->
                    <a href="{{ route('incubations.show', $client->id) }}" class="btn btn-info">Ver Incubaciones</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

