@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4">
            <h1 class="text-2xl font-bold text-white mb-6 text-center">Añadir Cliente</h1>
        </div>
        <div class="p-6">
            <div class="max-w-md mx-auto">
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
                    <div class="mb-6">
                        <label for="correo" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
                        <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="correo" name="correo" value="{{ old('correo') }}" autofocus required>
                        @error('correo')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('clients.index') }}" class="bg-blue-900 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Regresar a Lista de Clientes
                        </a>
                        <button type="submit" class="bg-green-900 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Guardar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
