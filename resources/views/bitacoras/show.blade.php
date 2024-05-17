@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-8 text-blue-900">Detalles de la Bitácora</h1>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-blue-900 px-6 py-4">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <h2 class="text-2xl font-semibold text-white mb-2 sm:mb-0">ID de Bitácora: {{ $bitacora->id }}</h2>
                <div class="text-xl font-bold text-white">{{ $bitacora->cliente->nombre }}</div>
            </div>
        </div>
        <div class="px-6 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-100 rounded-lg p-4 sm:p-6">
                    <h3 class="text-xl font-semibold mb-2">Fecha de Recepción</h3>
                    <p class="text-gray-600">{{ $bitacora->fecha_recepcion }}</p>
                </div>
                <div class="bg-gray-100 rounded-lg p-4 sm:p-6">
                    <h3 class="text-xl font-semibold mb-2">Huevos al Inicio</h3>
                    <p class="text-gray-600">{{ $bitacora->huevos_inicio }}</p>
                </div>
                <div class="bg-gray-100 rounded-lg p-4 sm:p-6">
                    <h3 class="text-xl font-semibold mb-2">Huevos Malos</h3>
                    <p class="text-gray-600">{{ $bitacora->huevos_malos }}</p>
                </div>
                <div class="bg-gray-100 rounded-lg p-4 sm:p-6">
                    <h3 class="text-xl font-semibold mb-2">Huevos Incubados</h3>
                    <p class="text-gray-600">{{ $bitacora->huevos_incubados }}</p>
                </div>
                <div class="bg-gray-100 rounded-lg p-4 sm:p-6">
                    <h3 class="text-xl font-semibold mb-2">Fecha de Entrega</h3>
                    <p class="text-gray-600">{{ $bitacora->fecha_entrega }}</p>
                </div>
            </div>
            <div class="mt-8 flex justify-between">
                {{-- <a href="{{ route('bitacoras.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Regresar al Historial
                </a> --}}
                {{-- <a href="{{ route('bitacoras.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Regresar al Historial
                </a> --}}
                <a href="{{ route('bitacoras.index') }}" class="bg-gray-800 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md flex items-center">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Regresar al Historial
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
