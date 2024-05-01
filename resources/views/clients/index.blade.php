{{-- resources/views/clients/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold mb-4 md:mb-0">Lista de Clientes</h1>
        <a href="{{ route('clients.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Añadir Cliente
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Código</th>
                    <th class="py-3 px-6 text-left">Nombre</th>
                    <th class="py-3 px-6 text-left">Dirección</th>
                    <th class="py-3 px-6 text-left">Teléfono</th>
                    <th class="py-3 px-6 text-left">Correo</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($clients as $client)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $client->id }}</td>
                    <td class="py-3 px-6 text-left">{{ $client->codigo }}</td>
                    <td class="py-3 px-6 text-left">{{ $client->nombre }}</td>
                    <td class="py-3 px-6 text-left">{{ $client->direccion }}</td>
                    <td class="py-3 px-6 text-left">{{ $client->telefono }}</td>
                    <td class="py-3 px-6 text-left">{{ $client->correo }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex flex-col md:flex-row items-center justify-center">
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="mb-2 md:mb-0 md:mr-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Eliminar
                                </button>
                            </form>
                            <a href="{{ route('clients.edit', $client->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Editar
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
