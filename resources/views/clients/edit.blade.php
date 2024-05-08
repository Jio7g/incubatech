{{-- resources/views/clients/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Cliente</h1>
    <form method="POST" action="{{ route('clients.update', $client->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="codigo" class="block text-gray-700 text-sm font-bold mb-2">Código</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="codigo" name="codigo" value="{{ $client->codigo }}" required>
            @error('codigo')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nombre" name="nombre" value="{{ $client->nombre }}" required>
            @error('nombre')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="direccion" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="direccion" name="direccion" value="{{ $client->direccion }}" required>
            @error('direccion')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="telefono" name="telefono" value="{{ $client->telefono }}" required>
            @error('telefono')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
            <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="correo" name="correo" value="{{ $client->correo }}" required>
            @error('correo')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Actualizar Cliente
            </button>
            <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Regresar a la lista
            </a>
        </div>
    </form>
</div>
@endsection
