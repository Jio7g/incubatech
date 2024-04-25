{{-- resources/views/clients/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">Añadir Cliente</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->nombre }}</td>
                <td>{{ $client->direccion }}</td>
                <td>{{ $client->telefono }}</td>
                <td>{{ $client->correo }}</td>
                <td>
                    <!-- Botones de acción (editar, eliminar, etc.) -->

                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                    @csrf
                     @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Cliente</button>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
