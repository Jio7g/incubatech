@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Añadir Cliente</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="codigo" class="block text-gray-700 text-sm font-bold mb-2">Código</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="codigo" name="codigo" value="{{ old('codigo') }}" autofocus required>
            @error('codigo')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nombre" name="nombre" value="{{ old('nombre') }}" autofocus>
            @error('nombre')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="direccion" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="direccion" name="direccion" value="{{ old('direccion') }}" autofocus>
            @error('direccion')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="telefono" name="telefono" value="{{ old('telefono') }}" autofocus>
            @error('telefono')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
            <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="correo" name="correo" value="{{ old('correo') }}" autofocus required>
            @error('correo')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Guardar Cliente
        </button>
    </form>
</div>
@endsection
